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
    <Card>
        <template #content>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 gap-4">
                    <div class="relative mb-6" data-te-input-wrapper-init>
                        <label for="company_name">Request Id</label>
                        <InputText
                            type="text"
                            v-model="form.request_id"
                            placeholder="Request Id"
                            class="w-full rounded"
                        />
                        <span
                            v-if="error_request_id"
                            class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert"
                            >{{ error_request_id }}</span
                        >
                    </div>
                    <div class="relative mb-6" data-te-input-wrapper-init>
                        <label for="position"> Driver </label>
                        <Dropdown
                            v-model="form.driver_id"
                            :options="drivers"
                            optionLabel="full_name"
                            optionValue="id"
                            placeholder="Assing driver"
                            class="w-full md:w-14rem"
                        />
                        <span
                            v-if="error_driver_id"
                            class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert"
                            >{{ error_driver_id }}</span
                        >
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="relative mb-6" data-te-input-wrapper-init>
                        <label for="functions"> Pax </label>
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
                    <div class="relative mb-6" data-te-input-wrapper-init>
                        <label for="currently"> Service </label>
                        <Dropdown
                            v-model="form.service"
                            :options="services"
                            optionLabel="service_name"
                            optionValue="service_name"
                            placeholder="Service"
                            class="w-full md:w-14rem"
                        />
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="relative mb-6" data-te-input-wrapper-init>
                        <label for="functions"> Client </label>
                        <InputText
                            type="text"
                            v-model="form.client_name"
                            placeholder="Client name"
                            class="w-full rounded"
                        />
                        <span
                            v-if="error_client_name"
                            class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert"
                            >{{ error_client_name }}</span
                        >
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="relative mb-6" data-te-input-wrapper-init>
                        <label for="functions"> Hotel </label>
                        <InputText
                            type="text"
                            v-model="form.hotel"
                            placeholder="Hotel"
                            class="w-full rounded"
                        />
                        <span
                            v-if="error_hotel"
                            class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert"
                            >{{ error_hotel }}</span
                        >
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="relative mb-6" data-te-input-wrapper-init>
                        <label for="functions"> Flight </label>
                        <InputText
                            type="text"
                            v-model="form.flight"
                            placeholder="Flight"
                            class="w-full rounded"
                        />
                        <span
                            v-if="error_flight"
                            class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert"
                            >{{ error_flight }}</span
                        >
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="relative mb-6" data-te-input-wrapper-init>
                        <label for="functions"> Date </label>
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
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="relative mb-6" data-te-input-wrapper-init>
                        <label for="functions"> Time </label>
                        <Calendar v-model="form.time" timeOnly />
                        <span
                            v-if="error_time"
                            class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert"
                            >{{ error_time }}</span
                        >
                    </div>
                </div>

                <div class="relative mb-6" data-te-input-wrapper-init>
                    <label for="functions"> Agency </label>
                    <InputText
                        type="text"
                        v-model="form.agency"
                        placeholder="Agency"
                        class="w-full rounded"
                    />
                    <span
                        v-if="error_agency"
                        class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert"
                        >{{ error_agency }}</span
                    >
                </div>

                <div class="relative mb-6" data-te-input-wrapper-init>
                    <label for="functions"> Status </label>
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

                <div class="relative mb-6" data-te-input-wrapper-init>
                    <label for="functions"> Extras </label>
                    <InputText
                        type="text"
                        v-model="form.extras"
                        placeholder="Extras"
                        class="w-full rounded"
                    />
                    <span
                        v-if="error_extras"
                        class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert"
                        >{{ error_extras }}</span
                    >
                </div>
            </div>
        </template>
        <template #footer>
            <Button
                icon="pi pi-check"
                label="Save"
                @click="$emit('createBooking', form)"
            />
        </template>
    </Card>
</template>
