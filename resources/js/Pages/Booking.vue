<template>
    <AppLayout title="Booking">
        <BookingAdmin v-if="is_admin" />
        <BookingDriver v-else />
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import BookingAdmin from "@/Components/BookingAdmin.vue";
import BookingDriver from "@/Components/BookingDriver.vue";
import { usePage } from "@inertiajs/vue3";

const is_mobile = isMobile();
const is_admin = usePage().props.auth.user.profile === "Admin";

function isMobile() {
    if (screen.width <= 760) {
        return true;
    } else {
        return false;
    }
}
</script>
