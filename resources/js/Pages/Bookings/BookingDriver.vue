<script setup>
import DataTable from "primevue/datatable";
import InputText from "primevue/inputtext";
import Dropdown from "primevue/dropdown";
import Column from "primevue/column";
import { ref, onMounted } from "vue";
import { RideService } from "@/Services/RideService";
import { DriverService } from "@/Services/DriverService";
import { useToast } from "primevue/usetoast";
const toast = useToast();

const components = {
    DataTable,
    Column,
    InputText,
    Dropdown,
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

onMounted(() => {
    DriverService.getDrivers().then((data) => (drivers.value = data));
});

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
</script>

<style lang="scss" scoped>
::v-deep(.editable-cells-table td.p-cell-editing) {
    padding-top: 0;
    padding-bottom: 0;
}
</style>

<template>
    <div class="card px-4 rounded-md">
        <div class="flex justify-end mb-2 mt-2">
            <span class="p-input-icon-left w-full">
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
            :value="rides"
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
                    <Dropdown
                        v-if="field === 'driver_id'"
                        v-model="data[field]"
                        :options="drivers"
                        optionLabel="full_name"
                        optionValue="id"
                        placeholder="Assing driver"
                        class="w-full md:w-14rem"
                        disabled
                    />
                </template>
            </Column>
        </DataTable>
    </div>
</template>
