<script setup>
import DataTable from "primevue/datatable";
import InputText from "primevue/inputtext";
import InputNumber from "primevue/inputnumber";
import Dropdown from "primevue/dropdown";
import Calendar from "primevue/calendar";
import Column from "primevue/column";
import { ref, onMounted } from "vue";
import { RideService } from "@/Services/RideService";
import { DriverService } from "@/Services/DriverService";
import BookingCreateForm from "./BookingCreateForm.vue";
import { useToast } from "primevue/usetoast";
import moment from "moment-timezone";

const toast = useToast();

const components = {
    DataTable,
    Column,
    InputText,
    InputNumber,
    Dropdown,
    Calendar,
    BookingCreateForm,
};

const columns = [
    { field: "request_id", header: "ID" },
    { field: "driver_id", header: "Driver" },
    { field: "pax", header: "Pax" },
    { field: "service", header: "Service" },
    { field: "client_name", header: "Client" },
    { field: "hotel", header: "Hotel" },
    { field: "flight", header: "Flight" },
    { field: "date", header: "Date" },
    { field: "time", header: "Time" },
    { field: "agency", header: "Agency" },
    { field: "status", header: "Status" },
    { field: "extras", header: "Extras" },
];

const services = [
    { service_name: "LLegada" },
    { service_name: "Salida" },
    { service_name: "Traslado" },
];

const editingRows = ref([]);
let drivers = ref([]);
let rides = ref([]);
let searchdate = ref();
let modalDisplay = ref(false);
let contains = ref();

let form = {
    id: null,
    request_id: null,
    driver_id: null,
    pax: null,
    service: null,
    client_name: null,
    hotel: null,
    flight: null,
    date: null,
    time: null,
    agency: null,
    status: null,
    extras: null,
};

onMounted(() => {
    console.log({ drivers });
    DriverService.getDrivers().then((data) => (drivers.value = data));
});

const createBooking = (bookingForm) => {
    RideService.createRide(bookingForm);
    modalDisplay.value = false;
    RideService.getRides().then((data) => {
        rides.value = data;
    });
    toast.add({
        severity: "info",
        summary: "Info",
        detail: "Successfully saved",
        life: 3000,
    });
};

const onRowEditSave = (event) => {
    let { newData } = event;

    const rideDate = moment(newData.date).format("DD/MM/YY");

    Object.keys(form).forEach(function (key) {
        if (key === "date") {
            form[key] = moment(newData[key], "DD/MM/YYYY").format(
                "ddd MMM DD YYYY HH:mm:ss [GMT]"
            );
        } else {
            form[key] = newData[key];
        }
    });

    console.log({ form });

    RideService.updateRide(form);

    newData.date = rideDate;

    rides.value.map((ride, index) => {
        if (ride.id === newData.id) {
            rides.value[index] = newData;
        }
    });
};

const onBookingFilterByDate = (date) => {
    RideService.getRideByDate(date).then((data) => {
        rides.value = data;

        if (data.length <= 0) {
            toast.add({
                severity: "info",
                summary: "Info",
                detail: "no records have been found with the date provided.",
                life: 3000,
            });
        }
    });
};

const bookingFilter = () => {
    RideService.filter(contains.value).then((data) => {
        rides.value = data;
    });
};
</script>

<style lang="scss" scoped>
::v-deep(.editable-cells-table td.p-cell-editing) {
    padding-top: 0;
    padding-bottom: 0;
}
</style>

<template>
    <Dialog
        modal
        header="Create booking"
        :style="{ width: '60vw' }"
        v-model:visible="modalDisplay"
    >
        <BookingCreateForm
            :drivers="drivers"
            :services="services"
            @createBooking="createBooking"
        />
    </Dialog>

    <div class="card px-4">
        <div class="flex justify-end mb-2 mt-2">
            <span class="p-input-icon-left w-full">
                <InputText
                    v-model="contains"
                    type="text"
                    placeholder="filter by ID or Client"
                    v-on:keyup.enter="bookingFilter"
                />
                <Button
                    label="Filter"
                    aria-label="Filter"
                    class="ml-2"
                    :onclick="bookingFilter"
                />
            </span>
            <span class="p-input-icon-left w-full">
                <Button
                    icon="pi pi-plus"
                    aria-label="New"
                    class="float-right"
                    :onclick="() => (modalDisplay = true)"
                />
                <Calendar
                    v-model="searchdate"
                    showIcon
                    showButtonBar
                    @date-select="onBookingFilterByDate"
                    dateFormat="dd/mm/yy"
                    class="float-right mr-2"
                />
            </span>
        </div>

        <DataTable
            v-model:filters="filters"
            v-model:editingRows="editingRows"
            :value="rides"
            dataKey="id"
            editMode="row"
            @row-edit-save="onRowEditSave"
            tableClass="editable-cells-table"
            tableStyle="max-width: 150rem"
            scrollable
            scrollHeight="400px"
        >
            <Column
                v-for="col of columns"
                :key="col.field"
                :field="col.field"
                :header="col.header"
            >
                <template
                    v-if="col.field === 'driver_id'"
                    #body="{ data, field }"
                >
                    <span>
                        {{
                            drivers.filter((driver) => {
                                return (driver.id = data[field]);
                            })[0]?.full_name
                        }}
                    </span>
                </template>

                <template #editor="{ data, field }">
                    <template
                        v-if="
                            field === 'driver_id' ||
                            field === 'pax' ||
                            field === 'service' ||
                            field === 'date' ||
                            field === 'time'
                        "
                    >
                        <Dropdown
                            v-if="field === 'driver_id'"
                            v-model="data[field]"
                            :options="drivers"
                            optionLabel="full_name"
                            optionValue="id"
                            placeholder="Assing driver"
                            class="w-full md:w-14rem"
                        />
                        <InputMask
                            v-if="field === 'pax'"
                            v-model="data[field]"
                            mask="9.9"
                            placeholder="00.00"
                            class="w-full"
                        />
                        <Dropdown
                            v-if="field === 'service'"
                            v-model="data[field]"
                            :options="services"
                            optionLabel="service_name"
                            optionValue="service_name"
                            placeholder="Service type"
                            class="w-full md:w-14rem"
                        />

                        <Calendar
                            v-if="field === 'date'"
                            v-model="data[field]"
                            dateFormat="dd/mm/yy"
                            showButtonBar
                        />
                        <InputMask
                            v-if="field === 'time'"
                            v-model="data[field]"
                            mask="99:99"
                            placeholder="23:00"
                        />
                    </template>

                    <InputText
                        v-else
                        v-model="data[field]"
                        autofocus
                        class="w-full"
                    />
                </template>
            </Column>
            <Column
                :rowEditor="true"
                style="width: 10%; min-width: 8rem"
                bodyStyle="text-align:center"
            ></Column>
        </DataTable>
    </div>
</template>
