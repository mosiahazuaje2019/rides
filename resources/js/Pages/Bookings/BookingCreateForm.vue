<script setup>
import { reactive } from "vue";

let form = reactive({
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
});

const props = defineProps({
    drivers: { type: Object, required: true },
    services: { default: [] },
});
</script>

<template>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="card flex flex-wrap gap-3 p-fluid">
            <div class="relative flex-auto" data-te-input-wrapper-init>
                <label for="request_id" >Request Id</label>
                <InputText
                    id="request_id"
                    type="text"
                    v-model="form.request_id"
                    placeholder=" "
                    class="w-full"
                />
                <span
                    v-if="error_request_id"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                    role="alert"
                    >{{ error_request_id }}</span
                >
            </div>
            <div class="relative flex-auto" data-te-input-wrapper-init>
                <label for="drivers"> Driver </label>
                <Dropdown
                    id = "drivers"
                    v-model="form.driver_id"
                    :options="drivers"
                    optionLabel="full_name"
                    optionValue="id"
                    placeholder="Select Driver"
                    class="w-full"
                />
                <span
                    v-if="error_driver_id"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                    role="alert"
                    >{{ error_driver_id }}</span
                >
            </div>
            <div class="relative flex-auto" data-te-input-wrapper-init>
                <label for="pax"> Pax </label>
                <InputMask
                    v-model="form.pax"
                    date="reference_phone"
                    mask="99:99"
                    placeholder="00:00"
                    class="w-full"
                />
                <span
                    v-if="error_pax"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                    role="alert"
                    >{{ error_pax }}</span
                >
            </div>
        </div>
        <div class="card flex flex-wrap gap-2 p-fluid">
            <div class="relative mt-4 flex-auto" data-te-input-wrapper-init>
                <label for="service"> Service </label>
                <Dropdown
                    v-model="form.service"
                    :options="services"
                    optionLabel="service_name"
                    optionValue="service_name"
                    placeholder="Service"
                    class="w-full"
                />
            </div>
            <div class="relative mt-4 flex-auto" data-te-input-wrapper-init>
                <label for="client"> Client </label>
                <InputText
                    type="text"
                    v-model="form.client_name"
                    placeholder="Client name"
                    class="w-full"
                />
                <span
                    v-if="error_client_name"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                    role="alert"
                    >{{ error_client_name }}</span
                >
            </div>
        </div>
        <div class="card flex flex-wrap gap-2 p-fluid">
            <div class="relative mt-4 flex-auto" data-te-input-wrapper-init>
                <label for="hotel"> Hotel </label>
                <InputText
                    type="text"
                    v-model="form.hotel"
                    placeholder="Hotel"
                    class="w-full"
                />
                <span
                    v-if="error_hotel"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                    role="alert"
                    >{{ error_hotel }}</span
                >
            </div>
            <div class="relative mt-4 flex-auto" data-te-input-wrapper-init>
                <label for="flight"> Flight </label>
                <InputText
                    type="text"
                    v-model="form.flight"
                    placeholder="Flight"
                    class="w-full"
                />
                <span
                    v-if="error_flight"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                    role="alert"
                    >{{ error_flight }}</span
                >
            </div>
        </div>
        <div class="card flex flex-wrap gap-3 p-fluid">
            <div class="relative mt-4 flex-auto" data-te-input-wrapper-init>
                <label for="date"> Date </label>
                <Calendar
                    v-model="form.date"
                    dateFormat="dd/mm/yy"
                    showButtonBar
                />
                <span
                    v-if="error_date"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                    role="alert"
                    >{{ error_date }}</span
                >
            </div>
            <div class="relative mt-4 flex-auto" data-te-input-wrapper-init>
                <label for="time"> Time </label>
                <Calendar v-model="form.time" timeOnly />
                <span
                    v-if="error_time"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                    role="alert"
                    >{{ error_time }}</span
                >
            </div>
            <div class="relative mt-4 flex-auto" data-te-input-wrapper-init>
            <label for="agency"> Agency </label>
            <InputText
                type="text"
                v-model="form.agency"
                placeholder="Agency"
                class="w-full"
            />
            <span
                v-if="error_agency"
                class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                role="alert"
                >{{ error_agency }}</span
            >
            </div>
        </div>
        <div class="card flex flex-wrap gap-2 p-fluid">
            <div class="relative mt-4 flex-auto" data-te-input-wrapper-init>
                <label for="status"> Status </label>
                <InputText
                    type="text"
                    v-model="form.status"
                    placeholder="Status"
                    class="w-full rounded"
                />
                <span
                    v-if="error_status"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                    role="alert"
                    >{{ error_status }}</span
                >
            </div>
            <div class="relative mt-4 flex-auto" data-te-input-wrapper-init>
                <label for="extras"> Extras </label>
                <InputText
                    type="text"
                    v-model="form.extras"
                    placeholder="Extras"
                    class="w-full"
                />
                <span
                    v-if="error_extras"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                    role="alert"
                    >{{ error_extras }}</span
                >
            </div>
        </div>
    </div>


    <Button
        class="float-right"
        icon="pi pi-check"
        label="Save"
        @click="$emit('createBooking', form)"
    />


</template>
