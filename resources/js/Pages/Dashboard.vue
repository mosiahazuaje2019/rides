<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, onMounted } from "vue";

    const chartData = ref({
        labels: ['Luis Alberto', 'Maria Paola', 'Elieser Reyes', 'Mosiah Azuaje', 'Alex Rodriguez'],
        datasets: [
            {
                label: 'Total de viajes',
                data: [40, 20, 100, 90,1000],
                backgroundColor: ['rgba(255, 159, 64, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(153, 102, 255, 0.2)'],
                borderColor: ['rgb(255, 159, 64)', 'rgb(75, 192, 192)', 'rgb(54, 162, 235)', 'rgb(153, 102, 255)'],
                borderWidth: 1
            }
        ]
    });
    const chartOptions = ref({
        scales: {
            y: {
                beginAtZero: true
            }
        }
    });

    onMounted(() => {
    chartData2.value = setChartData();
    chartOptions2.value = setChartOptions();
    products.value = [
        {
            id: '1000',
            name: 'Luis Alberto',
            hotel: 'Hilton los Cabos',
            pax: '1:2',
            service: 'Llegada',
            client: 'Smith Karl',
        },
        {
            id: '1002',
            name: 'Luis Alberto',
            hotel: 'Eurobuilding los Cabos',
            pax: '1:2',
            service: 'Salida',
            client: 'Sonyia',
        },
        {
            id: '1003',
            name: 'Maria Paola',
            hotel: 'Ryu los Cabos',
            pax: '1:2',
            service: 'Llegada',
            client: 'Mark',
        },
        {
            id: '1004',
            name: 'Eliser Reyes',
            hotel: 'BD los Cabos',
            pax: '1:2',
            service: 'Llegada',
            client: 'Veronica',
        },
        {
            id: '1005',
            name: 'Luis Alberto',
            hotel: 'HM los Cabos',
            pax: '2:2',
            service: 'Salida',
            client: 'Martha',
        },
    ]
});

const chartData2 = ref();
const chartOptions2 = ref();
const products = ref();
const dt = ref();
const exportCSV = () => {
    dt.value.exportCSV();
};

const setChartData = () => {
    const documentStyle = getComputedStyle(document.documentElement);

    return {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [
            {
                label: 'Salidas',
                backgroundColor: documentStyle.getPropertyValue('--blue-500'),
                borderColor: documentStyle.getPropertyValue('--blue-500'),
                data: [65, 59, 80, 81, 56, 55, 40]
            },
            {
                label: 'Llegadas',
                backgroundColor: documentStyle.getPropertyValue('--yellow-500'),
                borderColor: documentStyle.getPropertyValue('--yellow-500'),
                data: [28, 48, 40, 19, 86, 27, 90]
            }
        ]
    };
};
const setChartOptions = () => {
    const documentStyle = getComputedStyle(document.documentElement);
    const textColor = documentStyle.getPropertyValue('--text-color');
    const textColorSecondary = documentStyle.getPropertyValue('--text-color-secondary');
    const surfaceBorder = documentStyle.getPropertyValue('--surface-border');

    return {
        maintainAspectRatio: false,
        aspectRatio: 0.8,
        plugins: {
            legend: {
                labels: {
                    fontColor: textColor
                }
            }
        },
        scales: {
            x: {
                ticks: {
                    color: textColorSecondary,
                    font: {
                        weight: 500
                    }
                },
                grid: {
                    display: false,
                    drawBorder: false
                }
            },
            y: {
                ticks: {
                    color: textColorSecondary
                },
                grid: {
                    color: surfaceBorder,
                    drawBorder: false
                }
            }
        }
    };
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div>
                        <div class="card flex flex-wrap gap-2 p-fluid">
                            <div class="flex-auto w-11/12">
                                <div class="card">
                                    <h2 class="p-4">Reporte por chofer</h2>
                                    <Chart type="bar" :data="chartData" :options="chartOptions" />
                                </div>
                            </div>
                            <div class="flex-auto w-11/12">
                                <div class="card">
                                    <h2 class="p-4">Reporte de salidas y llegadas</h2>
                                    <Chart type="bar" :data="chartData2" :options="chartOptions" class="h-30rem"  />
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="card">
                                <h2 class="p-4">Reporte general por rango de fechas</h2>

                                <div class="card flex flex-wrap gap-3 p-fluid">
                                    <div class="flex-auto">
                                        <label for="calendar-24h" class="font-bold block mb-2"> Fecha de inicio </label>
                                        <Calendar id="calendar-24h" v-model="datetime24h" showTime hourFormat="12" />
                                    </div>
                                    <div class="flex-auto">
                                        <label for="calendar-timeonly" class="font-bold block mb-2"> Fecha fin </label>
                                        <Calendar id="calendar-timeonly" v-model="datetime12" showTime hourFormat="12" />
                                    </div>
                                    <div class="flex-auto pt-8">
                                        <Button icon="pi pi-external-link" label="Export" @click="exportCSV($event)" />
                                    </div>
                                </div>

                                <DataTable :value="products" ref="dt" tableStyle="min-width: 50rem">
                                    <Column field="id" header="Code"></Column>
                                    <Column field="name" header="Name"></Column>
                                    <Column field="pax" header="Pax"></Column>
                                    <Column field="service" header="Servicio"></Column>
                                    <Column field="client" header="Cliente"></Column>
                                </DataTable>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
