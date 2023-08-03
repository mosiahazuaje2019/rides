<script setup>
import "primeflex/primeflex.css";
import { ref, onMounted } from "vue";
import DataView from "primevue/dataview";

const components = {
    DataView,
};

// import { RideService } from "@/service/RideService";

// onMounted(() => {
//     RideService.getRides().then(
//         (data) => (rides.value = data.slice(0, 5))
//     );
// });

// const products = ref();
const getSeverity = (product) => {
    switch (product.inventoryStatus) {
        case "INSTOCK":
            return "success";

        case "LOWSTOCK":
            return "warning";

        case "OUTOFSTOCK":
            return "danger";

        default:
            return null;
    }
};

let rides = [
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
</script>

<template>
    <DataView :value="rides">
        <template #list="slotProps">
            <div class="col-12">
                <div
                    class="flex flex-column xl:flex-row xl:align-items-start p-4 gap-4"
                >
                    <div
                        class="flex flex-column sm:flex-row justify-content-between align-items-center xl:align-items-start flex-1 gap-4"
                    >
                        <div class="flex flex-column align-items-start gap-3">
                            <div class="text-xl text-900">
                                ID: {{ slotProps.data.request_id }}
                            </div>
                            <div class="flex align-items-center gap-3">
                                <span class="flex align-items-center gap-2">
                                    <!-- <i class="pi pi-car text-yellow-400"></i> -->
                                    <font-awesome-icon
                                        icon="taxi"
                                        class="text-yellow-400"
                                    />
                                    <span class="font-semibold">{{
                                        slotProps.data.driver
                                    }}</span>
                                </span>
                            </div>
                            <div class="text-xl text-900">
                                <font-awesome-icon
                                    icon="users"
                                    class="text-blue-600"
                                />
                                {{ slotProps.data.pax }}
                            </div>
                            <div class="text-xl text-900">
                                <!-- <font-awesome-icon icon="plane" /> -->
                                {{ slotProps.data.service }}
                            </div>
                            <div class="text-xl font-bold text-900">
                                <font-awesome-icon
                                    icon="user-tie"
                                    class="text-blue-600"
                                />
                                {{ slotProps.data.client_name }}
                            </div>
                            <div
                                class="flex sm:flex-column align-items-center sm:align-items-end gap-3 sm:gap-2"
                            >
                                <span class="text-xl font-semibold">{{
                                    slotProps.data.hotel
                                }}</span>
                            </div>
                            <div class="text-xl text-900">
                                <font-awesome-icon icon="plane" />
                                {{ slotProps.data.flight }}
                            </div>
                            <div class="text-xl text-900">
                                <!-- <font-awesome-icon icon="plane" /> -->
                                {{ slotProps.data.date }}
                            </div>
                            <div class="text-xl text-900">
                                <!-- <font-awesome-icon icon="plane" /> -->
                                {{ slotProps.data.time }}
                            </div>
                            <div class="text-xl text-900">
                                <!-- <font-awesome-icon icon="plane" /> -->
                                {{ slotProps.data.agency }}
                            </div>
                            <div class="text-xl text-900">
                                <!-- <font-awesome-icon icon="plane" /> -->
                                {{ slotProps.data.status }}
                            </div>
                            <div class="text-xl text-900">
                                <!-- <font-awesome-icon icon="plane" /> -->
                                {{ slotProps.data.extras }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </DataView>
</template>
