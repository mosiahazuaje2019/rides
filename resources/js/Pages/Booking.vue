<template>
    <AppLayout title="Booking">
        <BookingAdmin v-if="is_admin" />
        <!-- <BookingDriver /> -->
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
// import Banner from "@/Components/Banner.vue";
import BookingAdmin from "@/Components/BookingAdmin.vue";
import BookingDriver from "@/Components/BookingDriver.vue";

const is_mobile = isMobile();
const is_admin = true;

function isMobile() {
    if (screen.width <= 760) {
        return true;
    } else {
        return false;
    }
}
</script>
