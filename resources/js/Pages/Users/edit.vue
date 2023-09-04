<template>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="grid grid-cols-3 gap-4">
            <div class="relative mb-4" data-te-input-wrapper-init>
                <label for="name"> Name </label>
                <InputText
                    type="text"
                    v-model="form.name"
                    placeholder="Name"
                    class="w-full rounded"
                />
                <span
                    v-if="error_name"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                    role="alert"
                    >{{ error_name }}</span
                >
            </div>
            <div class="relative mb-4" data-te-input-wrapper-init>
                <label for="last_name"> Last name </label>
                <InputText
                    type="text"
                    v-model="form.last_name"
                    placeholder="Last name"
                    class="w-full rounded"
                />
                <span
                    v-if="error_last_name"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                    role="alert"
                    >{{ error_last_name }}</span
                >
            </div>
            <div class="relative mb-4" data-te-input-wrapper-init>
                <label for="phone"> Phone number </label>
                <InputText
                    type="text"
                    v-model="form.phone"
                    placeholder="phone number"
                    class="w-full rounded"
                />
                <span
                    v-if="error_phone"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                    role="alert"
                    >{{ error_phone }}</span
                >
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div class="relative mb-6" data-te-input-wrapper-init>
                <label for="profile"> Profile </label>
                <Dropdown
                    v-model="form.profile"
                    :options="profiles"
                    optionLabel="name"
                    optionValue="id"
                    placeholder="profile"
                    class="w-full"
                />
                <span
                    v-if="error_profile"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                    role="alert"
                    >{{ error_profile }}</span
                >
            </div>
            <div class="relative mb-6" data-te-input-wrapper-init>
                <label for="email"> Email </label>
                <InputText
                    type="text"
                    v-model="form.email"
                    placeholder="Email address"
                    class="w-full rounded"
                />
                <span
                    v-if="error_email"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                    role="alert"
                    >{{ error_email }}</span
                >
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div class="relative mb-6" data-te-input-wrapper-init>
                <label for="password"> Ingrese su contraseña </label>
                <Password
                    v-model="form.password"
                    placeholder="Password"
                    class="w-full"
                />
                <span
                    v-if="error_password"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                    role="alert"
                    >{{ error_password }}
                </span>
            </div>
        </div>
        <Button icon="pi pi-check" label="Guardar" @click="submit" />
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "UserEdit",
    data() {
        return {
            form: {
                name: null,
                last_name: null,
                phone: null,
                profile: null,
                email: null,
                password: null,
            },
            profiles: [
                { id: "Admin", name: "Admin" },
                { id: "Driver", name: "Driver" },
            ],
            error_name: null,
            error_last_name: null,
            error_phone: null,
            error_profile: null,
            error_email: null,
            error_password: null
        };
    },
    props: {
        userId: Number,
    },
    methods: {
        async submit() {
            if (!this.$props.userId) {
                try {
                    const res = await axios.post(`/api/v1/users`, this.form);
                    return this.emitter.emit("users_reload");
                } catch (e) {
                    if (e.response) {
                        switch (e.response.status) {
                            case 422:
                                let err = e.response.data.errors;
                                this.error_name = err.name ? err.name[0] : null;
                                this.error_last_name = err.last_name
                                    ? err.last_name[0]
                                    : null;
                                this.error_phone = err.phone
                                    ? err.phone[0]
                                    : null;
                                this.error_profile = err.profile
                                    ? err.profile[0]
                                    : null;
                                this.error_email = err.email
                                    ? err.email[0]
                                    : null;
                        }
                    }
                }
            }
            try {

                //Validate if null password if is true delete from object
                this.form.password === null ? delete this.form.password :  this.form

                const res = await axios.put(`/api/v1/users/${this.$props.userId}`,this.form);
                return this.emitter.emit("users_reload");
            } catch (e) {
                if (e.response) {
                    switch (e.response.status) {
                        case 422:
                            let err = e.response.data.errors;
                            console.log(err);
                            this.error_name = err.name ? err.name[0] : null;
                            this.error_last_name = err.last_name
                                ? err.last_name[0]
                                : null;
                            this.error_phone = err.phone ? err.phone[0] : null;
                            this.error_profile = err.profile
                                ? err.profile[0]
                                : null;
                            this.error_email = err.email ? err.email[0] : null;
                    }
                }
            }
        },
        async getUserEdit(userId) {
            const res = await axios.get(`/api/v1/users/${userId}`);
            this.form.name = res.data.name;
            this.form.last_name = res.data.last_name;
            this.form.phone = res.data.phone;
            this.form.profile = res.data.profile;
            this.form.email = res.data.email;
        },
    },
    mounted() {
        if (this.$props.userId) {
            this.getUserEdit(this.$props.userId);
        }
    },
};
</script>
