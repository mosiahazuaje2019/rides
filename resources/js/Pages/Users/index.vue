<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});
</script>

<template>
    <AppLayout title="Profile">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Users
                <span class="float-right px-4 mt-0">
                    <PrimeButton @click="createUser()" icon="pi pi-plus" title="Crear Usuario" />
                </span>
            </h2>
        </template>

        <div>

        </div>
        <div class="px-4 mt-2">
            <DataTable
                :value="users"
                dataKey="id"
                tableStyle="min-width: 50rem"
                :paginator="true"
                :rows="5"
                responsiveLayout="scroll"
            >
                <Column field="full_name" header="Full name"></Column>
                <Column field="phone" header="Phone"></Column>
                <Column field="profile" header="Profile"></Column>
                <Column
                    bodyStyle="justify-center"
                    header="Acción"
                    headerStyle="width: 14rem; justify-center"
                >
                    <template #body="slotProps">
                        <PrimeButton
                            @click="editUser(slotProps.data.id)"
                            icon="pi pi-pencil"
                            class="buttonEdit"
                            title="Edit User"
                        />
                        <PrimeButton
                            @click="deleteUser(slotProps.data.id)"
                            icon="pi pi-trash"
                            class="buttonDelete"
                            title="Delete User"
                        />
                    </template>
                </Column>
            </DataTable>
        </div>
    </AppLayout>

    <Dialog
        modal
        :header="userId === null ? 'Create user' : 'Edit user'"
        :style="{ width: '60vw' }"
        v-model:visible="display"
    >
        <UserEdit :userId="userId" />
    </Dialog>
</template>

<script>
import axios from "axios";
import UserEdit from "./edit.vue";
import Swal from "sweetalert2";

export default {
    name: "User",
    components: {
        UserEdit,
    },
    data() {
        return {
            users: null,
            userId: null,
            display: false,
            form: {
                user_id: null,
            },
            error_user_id: null,
        };
    },
    methods: {
        getListUsers() {
            axios.get("/api/v1/users").then((res) => {
                this.users = res.data;
            });
        },
        createUser(){
            this.userId = null;
            this.display = true;
       },
        editUser(userId) {
            this.userId = userId;
            this.display = true;
        },
        async deleteUser(userId) {
            Swal.fire({
                title: "Are you sure you want to delete the record",
                showDenyButton: true,
                confirmButtonText: `Delete`,
                denyButtonText: `Cancel`,
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .delete(`/api/v1/users/${userId}`)
                        .then(() => {
                            return this.emitter.emit("users_reload");
                        })
                        .catch(() => {
                            Swal.fire(
                                "Unable to delete the record",
                                "",
                                "error"
                            );
                        });
                } else if (result.isDenied) {
                    Swal.fire("No record deleted...", "", "info");
                }
            });
        },
        async asignDriver(userId) {
            const formData = { user_id: userId };

            try {
                const res = await axios.post("/api/v1/drivers/", formData);
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "User was configured as a driver, correctly",
                    showConfirmButton: false,
                    timer: 3000,
                });
            } catch (e) {
                if (e.response) {
                    switch (e.response.status) {
                        case 422:
                            let err = e.response.data.errors;
                            this.error_user_id = err.user_id
                                ? err.user_id[0]
                                : null;
                            Swal.fire({
                                position: "top-start",
                                icon: "error",
                                title: this.error_user_id,
                                showConfirmButton: false,
                                timer: 3000,
                            });
                            break;
                    }
                }
                return null;
            }
        },
    },
    mounted() {
        this.getListUsers();
        this.emitter.on("users_reload", () => {
            this.getListUsers();
            this.display = false;

            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "User was successfully edited",
                showConfirmButton: false,
                timer: 1500,
            });
        });
    },
};
</script>

<style>
.buttonDriver {
    color: #ffffff;
    background-color: green;
    margin-right: 2px;
    width: 20px;
}
.buttonEdit {
    color: #ffffff;
    background-color: gray;
    margin-right: 2px;
    width: 20px;
}
.buttonDelete {
    color: #ffffff;
    background-color: red;
    width: 20px;
}
</style>
