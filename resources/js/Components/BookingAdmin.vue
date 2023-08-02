<script setup>
import DataTable from "primevue/datatable";
import InputText from "primevue/inputtext";
import InputNumber from "primevue/inputnumber";
import Column from "primevue/column";
import {FilterMatchMode,FilterOperator} from 'primevue/api';
import { ref, onMounted } from "vue";


const components = {
    DataTable,
    Column,
    InputText,
    InputNumber,
};

const columns = [
    { field: "request_id", header: "ID" },
    { field: "driver", header: "Driver" },
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

// import { RideService } from "@/service/RideService";

// onMounted(() => {
//     RideService.getRides().then(
//         (data) => (rides.value = data.slice(0, 5))
//     );
// });

let rides = [
    {
        request_id: "15282",
        driver: "Juan Rey",
        pax: "2:2",
        service: "LLegada",
        client_name: "Alex Rodriguez",
        hotel: "Cabo Azul Resort, Paseo Malecon LT 11, Zona Hotelera, San José del Cabo, Baja California Sur, México",
        flight: "AA#123",
        date: "July 28, 2023",
        time: "15:20",
        agency: "Travel Agency",
        status: "#100",
        extras: "2 car seats/ compras",
    },
    {
        request_id: "15285",
        driver: "Elieser Reyes",
        pax: "2:2",
        service: "LLegada",
        client_name: "Alex Garcia",
        hotel: "Cabo Azul Resort, Paseo Malecon LT 11, Zona Hotelera, San José del Cabo, Baja California Sur, México",
        flight: "AA#123",
        date: "July 28, 2023",
        time: "15:20",
        agency: "Travel Agency",
        status: "#100",
        extras: "2 car seats/ compras",
    },
    {
        request_id: "15285",
        driver: "Elieser Reyes",
        pax: "2:2",
        service: "LLegada",
        client_name: "Alex Garcia",
        hotel: "Cabo Azul Resort, Paseo Malecon LT 11, Zona Hotelera, San José del Cabo, Baja California Sur, México",
        flight: "AA#123",
        date: "July 28, 2023",
        time: "15:20",
        agency: "Travel Agency",
        status: "#100",
        extras: "2 car seats/ compras",
    },
    {
        request_id: "15285",
        driver: "Elieser Reyes",
        pax: "2:2",
        service: "LLegada",
        client_name: "Alex Garcia",
        hotel: "Cabo Azul Resort, Paseo Malecon LT 11, Zona Hotelera, San José del Cabo, Baja California Sur, México",
        flight: "AA#123",
        date: "July 28, 2023",
        time: "15:20",
        agency: "Travel Agency",
        status: "#100",
        extras: "2 car seats/ compras",
    },
    {
        request_id: "15285",
        driver: "Elieser Reyes",
        pax: "2:2",
        service: "LLegada",
        client_name: "Alex Garcia",
        hotel: "Cabo Azul Resort, Paseo Malecon LT 11, Zona Hotelera, San José del Cabo, Baja California Sur, México",
        flight: "AA#123",
        date: "July 28, 2023",
        time: "15:20",
        agency: "Travel Agency",
        status: "#100",
        extras: "2 car seats/ compras",
    },
    {
        request_id: "15285",
        driver: "Elieser Reyes",
        pax: "2:2",
        service: "LLegada",
        client_name: "Alex Garcia",
        hotel: "Cabo Azul Resort, Paseo Malecon LT 11, Zona Hotelera, San José del Cabo, Baja California Sur, México",
        flight: "AA#123",
        date: "July 28, 2023",
        time: "15:20",
        agency: "Travel Agency",
        status: "#100",
        extras: "2 car seats/ compras",
    },
    {
        request_id: "15285",
        driver: "Elieser Reyes",
        pax: "2:2",
        service: "LLegada",
        client_name: "Alex Garcia",
        hotel: "Cabo Azul Resort, Paseo Malecon LT 11, Zona Hotelera, San José del Cabo, Baja California Sur, México",
        flight: "AA#123",
        date: "July 28, 2023",
        time: "15:20",
        agency: "Travel Agency",
        status: "#100",
        extras: "2 car seats/ compras",
    },
    {
        request_id: "15285",
        driver: "Elieser Reyes",
        pax: "2:2",
        service: "LLegada",
        client_name: "Alex Garcia",
        hotel: "Cabo Azul Resort, Paseo Malecon LT 11, Zona Hotelera, San José del Cabo, Baja California Sur, México",
        flight: "AA#123",
        date: "July 28, 2023",
        time: "15:20",
        agency: "Travel Agency",
        status: "#100",
        extras: "2 car seats/ compras",
    },
    {
        request_id: "15285",
        driver: "Elieser Reyes",
        pax: "2:2",
        service: "LLegada",
        client_name: "Alex Garcia",
        hotel: "Cabo Azul Resort, Paseo Malecon LT 11, Zona Hotelera, San José del Cabo, Baja California Sur, México",
        flight: "AA#123",
        date: "July 28, 2023",
        time: "15:20",
        agency: "Travel Agency",
        status: "#100",
        extras: "2 car seats/ compras",
    },
    {
        request_id: "15285",
        driver: "Elieser Reyes",
        pax: "2:2",
        service: "LLegada",
        client_name: "Alex Garcia",
        hotel: "Cabo Azul Resort, Paseo Malecon LT 11, Zona Hotelera, San José del Cabo, Baja California Sur, México",
        flight: "AA#123",
        date: "July 28, 2023",
        time: "15:20",
        agency: "Travel Agency",
        status: "#100",
        extras: "2 car seats/ compras",
    },
    {
        request_id: "15285",
        driver: "Elieser Reyes",
        pax: "2:2",
        service: "LLegada",
        client_name: "Alex Garcia",
        hotel: "Cabo Azul Resort, Paseo Malecon LT 11, Zona Hotelera, San José del Cabo, Baja California Sur, México",
        flight: "AA#123",
        date: "July 28, 2023",
        time: "15:20",
        agency: "Travel Agency",
        status: "#100",
        extras: "2 car seats/ compras",
    },
    {
        request_id: "15285",
        driver: "Elieser Reyes",
        pax: "2:2",
        service: "LLegada",
        client_name: "Alex Garcia",
        hotel: "Cabo Azul Resort, Paseo Malecon LT 11, Zona Hotelera, San José del Cabo, Baja California Sur, México",
        flight: "AA#123",
        date: "July 28, 2023",
        time: "15:20",
        agency: "Travel Agency",
        status: "#100",
        extras: "2 car seats/ compras",
    },
    {
        request_id: "15285",
        driver: "Elieser Reyes",
        pax: "2:2",
        service: "LLegada",
        client_name: "Alex Garcia",
        hotel: "Cabo Azul Resort, Paseo Malecon LT 11, Zona Hotelera, San José del Cabo, Baja California Sur, México",
        flight: "AA#123",
        date: "July 28, 2023",
        time: "15:20",
        agency: "Travel Agency",
        status: "#100",
        extras: "2 car seats/ compras",
    },
    {
        request_id: "15285",
        driver: "Elieser Reyes",
        pax: "2:2",
        service: "LLegada",
        client_name: "Alex Garcia",
        hotel: "Cabo Azul Resort, Paseo Malecon LT 11, Zona Hotelera, San José del Cabo, Baja California Sur, México",
        flight: "AA#123",
        date: "July 28, 2023",
        time: "15:20",
        agency: "Travel Agency",
        status: "#100",
        extras: "2 car seats/ compras",
    },
    {
        request_id: "15285",
        driver: "Elieser Reyes",
        pax: "2:2",
        service: "LLegada",
        client_name: "Alex Garcia",
        hotel: "Cabo Azul Resort, Paseo Malecon LT 11, Zona Hotelera, San José del Cabo, Baja California Sur, México",
        flight: "AA#123",
        date: "July 28, 2023",
        time: "15:20",
        agency: "Travel Agency",
        status: "#100",
        extras: "2 car seats/ compras",
    },
    {
        request_id: "15285",
        driver: "Elieser Reyes",
        pax: "2:2",
        service: "LLegada",
        client_name: "Alex Garcia",
        hotel: "Cabo Azul Resort, Paseo Malecon LT 11, Zona Hotelera, San José del Cabo, Baja California Sur, México",
        flight: "AA#123",
        date: "July 28, 2023",
        time: "15:20",
        agency: "Travel Agency",
        status: "#100",
        extras: "2 car seats/ compras",
    },
    {
        request_id: "15285",
        driver: "Elieser Reyes",
        pax: "2:2",
        service: "LLegada",
        client_name: "Alex Garcia",
        hotel: "Cabo Azul Resort, Paseo Malecon LT 11, Zona Hotelera, San José del Cabo, Baja California Sur, México",
        flight: "AA#123",
        date: "July 28, 2023",
        time: "15:20",
        agency: "Travel Agency",
        status: "#100",
        extras: "2 car seats/ compras",
    },
    {
        request_id: "15285",
        driver: "Elieser Reyes",
        pax: "2:2",
        service: "LLegada",
        client_name: "Alex Garcia",
        hotel: "Cabo Azul Resort, Paseo Malecon LT 11, Zona Hotelera, San José del Cabo, Baja California Sur, México",
        flight: "AA#123",
        date: "July 28, 2023",
        time: "15:20",
        agency: "Travel Agency",
        status: "#100",
        extras: "2 car seats/ compras",
    },
    {
        request_id: "15285",
        driver: "Elieser Reyes",
        pax: "2:2",
        service: "LLegada",
        client_name: "Alex Garcia",
        hotel: "Cabo Azul Resort, Paseo Malecon LT 11, Zona Hotelera, San José del Cabo, Baja California Sur, México",
        flight: "AA#123",
        date: "July 28, 2023",
        time: "15:20",
        agency: "Travel Agency",
        status: "#100",
        extras: "2 car seats/ compras",
    },
    {
        request_id: "15285",
        driver: "Elieser Reyes",
        pax: "2:2",
        service: "LLegada",
        client_name: "Alex Garcia",
        hotel: "Cabo Azul Resort, Paseo Malecon LT 11, Zona Hotelera, San José del Cabo, Baja California Sur, México",
        flight: "AA#123",
        date: "July 28, 2023",
        time: "15:20",
        agency: "Travel Agency",
        status: "#100",
        extras: "2 car seats/ compras",
    },
];

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    client_name: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
    driver: { value: null, matchMode: FilterMatchMode.STARTS_WITH },
});

function onCellEditComplete(event) {
    let { data, newValue, field } = event;
    data[field] = newValue;

    console.log({ data });
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
            :globalFilterFields="['client_name','driver']"
        >
            <template #header>
                <div class="flex justify-content-center">
                    <span class="p-input-icon-left w-full">
                        <i class="pi pi-search" />
                        <InputText v-model="filters['global'].value" placeholder="Buscar" class="w-full" />
                    </span>
                </div>
            </template>

            <Column
                v-for="col of columns"
                :key="col.field"
                :field="col.field"
                :header="col.header"
            >
                <template #editor="{ data, field }">
                    <InputText v-model="data[field]" autofocus class="w-full" />
                </template>
            </Column>
        </DataTable>
    </div>
</template>
