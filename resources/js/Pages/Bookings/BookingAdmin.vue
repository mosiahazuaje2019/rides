<script setup>
import DataTable from "primevue/datatable";
import InputText from "primevue/inputtext";
import InputNumber from "primevue/inputnumber";
import Dropdown from "primevue/dropdown";
import Calendar from "primevue/calendar";
import Column from "primevue/column";
import { FilterMatchMode, FilterOperator } from "primevue/api";
import { ref, onMounted } from "vue";
import { RideService } from "@/Services/RideService";
import { DriverService } from "@/Services/DriverService";

const components = {
    DataTable,
    Column,
    InputText,
    InputNumber,
    Dropdown,
    Calendar,
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

let drivers = ref([]);
let rides = ref([]);
let searchdate = ref();

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    client_name: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
    driver: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
});

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
    RideService.getRides().then((data) => (rides.value = data));
    DriverService.getDrivers().then((data) => (drivers.value = data));
});

function onCellEditComplete(event) {
    let { data, newValue, field } = event;

    if (field === "driver") {
        const driver_id = newValue;

        data[field] = drivers.value.filter(
            (driver) => driver.id === driver_id
        )[0].full_name;
    } else {
        data[field] = newValue;
    }

    // form = data;
    Object.keys(form).forEach(function (key) {
        form[key] = data[key];
    });

    RideService.updateRide(form);

    console.log("*****************************");
    console.log(form);
    console.log("*****************************");
    console.log({ newValue });
    console.log({ field });
}
</script>

<style lang="scss" scoped>
::v-deep(.editable-cells-table td.p-cell-editing) {
    padding-top: 0;
    padding-bottom: 0;
}
</style>

<template>
    <div class="card px-6">
        <div class="flex justify-center my-20">
            <h3>Booking</h3>
        </div>

        <div class="flex justify-end mb-2">
            <span class="p-input-icon-left w-full">
                <Button icon="pi pi-plus" aria-label="Nuevo" class="float-right" />
                <Calendar v-model="searchdate" showIcon dateFormat="dd/mm/yy" class="float-right mr-2" />
            </span>
        </div>

        <DataTable
            v-model:filters="filters"
            showGridlines
            paginator
            :rows="5"
            :rowsPerPageOptions="[5, 10, 20, 50]"
            :value="rides"
            editMode="cell"
            @cell-edit-complete="onCellEditComplete"
            tableClass="editable-cells-table"
            tableStyle="max-width: 150rem"
            :globalFilterFields="['client_name', 'driver']"
        >
            <template #header>
                <div class="flex justify-content-center  mt-2">
                    <span class="p-input-icon-left w-full">
                        <i class="pi pi-search" />
                        <InputText
                            v-model="filters['global'].value"
                            placeholder="Buscar"
                            class="w-full"
                        />
                    </span>
                </div>
            </template>

            <Column
                v-for="col of columns"
                :key="col.field"
                :field="col.field"
                :header="col.header"
            >
                <template
                    v-if="
                        col.field === 'driver_id' ||
                        col.field === 'date' ||
                        col.field === 'time'
                    "
                    #body="{ data, field }"
                >
                    <Dropdown
                        v-if="field === 'driver_id'"
                        v-model="data.driver_id"
                        :options="drivers"
                        optionLabel="full_name"
                        optionValue="id"
                        placeholder="Assing driver"
                        class="w-full md:w-14rem"
                    />

                    <Calendar v-if="field === 'date'" v-model="data[field]" dateFormat="dd/mm/yy" />
                    <Calendar
                        v-if="field === 'time'"
                        v-model="data.time"
                        timeOnly
                    />
                </template>

                <template #editor="{ data, field }">
                    <template
                        v-if="
                            field === 'driver_id' ||
                            field === 'service' ||
                            field === 'date' ||
                            field === 'time'
                        "
                    >
                        <Dropdown
                            v-if="field === 'driver_id'"
                            v-model="data.driver_id"
                            :options="drivers"
                            optionLabel="full_name"
                            optionValue="id"
                            placeholder="Assing driver"
                            class="w-full md:w-14rem"
                        />
                        <Dropdown
                            v-if="field === 'service'"
                            v-model="data.service"
                            :options="services"
                            optionLabel="service_name"
                            optionValue="service_name"
                            placeholder="Service type"
                            class="w-full md:w-14rem"
                        />

                        <Calendar v-if="field === 'date'" v-model="data.date" />
                        <Calendar
                            v-if="field === 'time'"
                            v-model="data.time"
                            timeOnly
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
        </DataTable>
    </div>
</template>
