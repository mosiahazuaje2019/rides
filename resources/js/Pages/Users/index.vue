<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';

    defineProps({
        confirmsTwoFactorAuthentication: Boolean,
        sessions: Array,
    });
</script>

<template>
    <AppLayout title="Profile">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Usuarios
            </h2>
        </template>

        <div class="px-4 mt-2">
            <DataTable :value="users" dataKey="id" tableStyle="min-width: 50rem"
                        :paginator="true"
                        :rows="5"
                        responsiveLayout="scroll">
                <Column field="full_name" header="Nombre completo"></Column>
                <Column field="phone" header="Teléfono"></Column>
                <Column field="profile" header="Perfil"></Column>
                <Column bodyStyle="justify-center" header="Acción"
                        headerStyle="width: 14rem; justify-center">
                    <template #body="slotProps">
                        <PrimeButton @click="editUser(slotProps.data.id)" icon="pi pi-pencil" class="buttonEdit" title="Editar Usuario" />
                        <PrimeButton @click="deleteUser(slotProps.data.id)" icon="pi pi-trash" class="buttonDelete" title="Borrar Usuario" />
                    </template>
                </Column>
            </DataTable>
        </div>
    </AppLayout>

    <Dialog modal :header="userId === null ? 'Crear usuario' : 'Editar usuario'" :style="{width: '60vw'}"
            v-model:visible="display">
        <UserEdit :userId="userId" />
    </Dialog>

</template>

<script>
import axios from 'axios';
import UserEdit from './edit.vue';
import Swal from 'sweetalert2'

export default {
    name: "User",
    components:{
        UserEdit
    },
    data() {
        return {
            users: null,
            userId: null,
            display: false,
            form: {
                user_id: null,
            },
            error_user_id: null
        }
    },
    methods: {
        getListUsers() {
            axios.get('/api/v1/users').then((res)=> {
                this.users = res.data;
            })
        },
        editUser(userId){
            this.userId = userId;
            this.display = true;
        },
       async  deleteUser(userId){
            Swal.fire({
                title: 'Seguro que desea eliminar el registro',
                showDenyButton: true,
                confirmButtonText: `Borrar`,
                denyButtonText: `No borrar`,
            }).then((result) => {
                if(result.isConfirmed) {
                    axios.delete(`/api/v1/users/${userId}`).then(() => {
                        return this.emitter.emit('users_reload')
                    }).catch(() =>{
                        Swal.fire('No se logro eliminar', '', 'error')
                    })
                } else if(result.isDenied) {
                    Swal.fire('No se ha borrado...', '', 'info')
                }
            })
        },
        async asignDriver(userId){
            const formData = { user_id: userId }

            try {
                const res = await axios.post("/api/v1/drivers/",formData)
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Usuario se configuro como chofer, correctamente',
                showConfirmButton: false,
                timer: 3000
                })
            }catch(e) {
                if(e.response) {
                    switch (e.response.status) {
                        case 422:
                            let err = e.response.data.errors
                            this.error_user_id = err.user_id ? err.user_id[0] : null
                            Swal.fire({
                                position: 'top-start',
                                icon: 'error',
                                title: this.error_user_id,
                                showConfirmButton: false,
                                timer: 3000
                            })
                            break;
                    }
                } return null
            }
        }
    },
    mounted(){
        this.getListUsers();
        this.emitter.on('users_reload', ()=>{
            this.getListUsers();
            this.display = false;

            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Usuario se edito correctamente',
            showConfirmButton: false,
            timer: 1500
            })
        })
    }
}
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
