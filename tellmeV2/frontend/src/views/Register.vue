<template>
    <div
        class="z-20 w-full flex flex-col h-screen space-y-8 py-4 px-8 md:w-[60%]"
    >
        <div class="flex items-center justify-end gap-4 w-full">
            <h3 class="block text-md text-gray-600">
                Already have an account ?
            </h3>
            <router-link
                to="/login"
                class="flex justify-center rounded-md bg-orange-600 px-4 py-2 text-md font-semibold text-white hover:text-orange-600 hover:bg-white hover:border hover:border-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
            >
                Login
            </router-link>
        </div>

        <div class="flex flex-col items-center justify-center h-full space-y-8">
            <form class="space-y-10 w-1/2" @submit.prevent="register">
                <div class="space-y-4">
                    <div class="flex flex-col gap-4 md:flex-row">
                        <div class="space-y-2">
                            <label for="first_name" class="pl-2 font-medium"
                                >Fisrt name</label
                            >
                            <input
                                id="first_name"
                                name="first_name"
                                v-model="credentials.first_name"
                                type="text"
                                autocomplete="name"
                                :class="
                                    !first_name_Error
                                        ? 'border-orange-600'
                                        : 'border-red-600'
                                "
                                class="relative block w-full rounded border py-2.5 text-gray-900 ring-1 ring-outset ring-orange-600 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-orange-600 sm:text-sm sm:leading-6"
                                placeholder="Fisrt name"
                            />
                            <p
                                v-show="first_name_Error"
                                id="first_name_Error"
                                class="mt-1 text-xs text-red-500"
                            >
                                {{ first_name_Error }}
                            </p>
                        </div>
                        <div class="space-y-2">
                            <label for="last_name" class="pl-2 font-medium"
                                >Last name</label
                            >
                            <input
                                id="last_name"
                                name="last_name"
                                v-model="credentials.last_name"
                                type="text"
                                autocomplete="name"
                                :class="
                                    !last_name_Error
                                        ? 'border-orange-500'
                                        : 'border-red-600'
                                "
                                class="relative block w-full rounded-md border py-2.5 text-gray-900 ring-1 ring-outset ring-orange-600 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-orange-600 sm:text-sm sm:leading-6"
                                placeholder="Last name"
                            />
                            <p
                                v-show="last_name_Error"
                                id="last_name_Error"
                                class="mt-1 text-xs text-red-500"
                            >
                                {{ last_name_Error }}
                            </p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="email-address" class="pl-2 font-medium"
                            >Email</label
                        >
                        <input
                            id="email-address"
                            name="email"
                            type="email"
                            v-model="credentials.email"
                            autocomplete="email"
                            :class="
                                !email_Error
                                    ? 'border-orange-500'
                                    : 'border-red-600 ring-none'
                            "
                            class="relative block w-full rounded-md border py-2.5 text-gray-900 ring-1 ring-outset ring-orange-600 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-orange-600 sm:text-sm sm:leading-6"
                            placeholder="Enter Your Email"
                        />
                        <p
                            v-show="email_Error"
                            id="email_Error"
                            class="mt-1 text-xs text-red-500"
                        >
                            {{ email_Error }}
                        </p>
                    </div>
                    <div class="flex flex-col gap-4 md:flex-row">
                        <div class="space-y-2">
                            <label for="password" class="pl-2 font-medium"
                                >Password</label
                            >
                            <input
                                id="password"
                                name="password"
                                v-model="credentials.password"
                                type="password"
                                autocomplete="current-password"
                                :class="
                                    !password_Error
                                        ? 'border-orange-500'
                                        : 'border-red-600  ring-none'
                                "
                                class="relative block w-full rounded-md border py-2.5 text-gray-900 ring-1 ring-outset ring-orange-600 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-orange-600 foucus:border-orange-400 sm:text-sm sm:leading-6"
                                placeholder="Password"
                            />
                            <p
                                v-show="password_Error"
                                id="password_Error"
                                class="mt-1 text-xs text-red-500"
                            >
                                {{ password_Error }}
                            </p>
                        </div>
                        <div class="space-y-2">
                            <label for="password" class="pl-2 font-medium"
                                >Confirm password</label
                            >
                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                v-model="credentials.password_confirmation"
                                type="password"
                                autocomplete="current-password"
                                class="relative block w-full rounded-md border border-orange-500 py-2.5 text-gray-900 ring-1 ring-outset ring-orange-600 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-orange-600 foucus:border-orange-400 sm:text-sm sm:leading-6"
                                placeholder="Confirm Password"
                            />
                        </div>
                    </div>
                </div>

                <div>
                    <button
                        type="submit"
                        class="group relative flex w-full justify-center rounded-md bg-orange-600 px-3 py-2.5 text-md font-semibold text-white hover:text-orange-600 hover:bg-white hover:border hover:border-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
                    >
                        Sign up
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { LockClosedIcon } from "@heroicons/vue/20/solid";
import axios from "axios";

export default {
    data() {
        return {
            credentials: {
                first_name: "",
                last_name: "",
                email: "",
                password: "",
                password_confirmation: "",
            },
            loading: true,
            error: "",
            first_name_Error: "",
            last_name_Error: "",
            email_Error: "",
            password_Error: "",
            password_confirmation_Error: "",
            token: this.$store.state.token,
        };
    },
    methods: {
        register() {
            axios
                .post("http://127.0.0.1:8000/api/v1/register", this.credentials)
                .then((response) => {
                    //   localStorage.setItem("token", response.data.token);
                    this.$store.commit("setToken", response.data.token);
                    // this.$store.commit("setId", response.data.user_id);
                    this.$store.commit("setUser", response.data.user);

                    this.$router.push("/");
                })
                .catch((error) => {
                    console.log("Error :", error.response);
                    console.log(
                        "Error Last :",
                        error.response.data.errors.last_name
                    );
                    if (error.response.data.errors.last_name) {
                        this.last_name_Error =
                            error.response.data.errors.last_name[0];
                    } else {
                        this.last_name_Error = "";
                    }
                    if (error.response.data.errors.first_name) {
                        this.first_name_Error =
                            error.response.data.errors.first_name[0];
                    } else {
                        this.first_name_Error = "";
                    }
                    if (error.response.data.errors.email) {
                        this.email_Error = error.response.data.errors.email[0];
                    } else {
                        this.email_Error = "";
                    }
                    if (error.response.data.errors.password) {
                        this.password_Error =
                            error.response.data.errors.password[0];
                    } else {
                        this.password_Error = "";
                    }
                    // if (error.response.data.errors.category_id) {
                    //     this.catyError =
                    //         error.response.data.errors.category_id[0];
                    // } else {
                    //     this.catyError = "";
                    // }
                });
        },
        // myPodcasts() {
        //     axios
        //         .post(
        //             "http://127.0.0.1:8000/api/v1/mypodcasts",
        //             this.$store.state.id
        //         )
        //         .then((response) => {
        //             console.log("Response My Podcasts : ", response);
        //             if (response.data) {
        //                 this.podcasts = response.data.data;
        //             }
        //         })
        //         .catch((error) => {
        //             console.log("Error My Podcasts:", error.response);
        //         });
        // },
    },

    mounted() {
        if (this.$store.state.token != null) {
            // axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
            axios
                .post("http://127.0.0.1:8000/api/v1/checkToken", {
                    Accept: "application/json",
                    Authorization: `Bearer ${this.$store.state.token}`,
                })
                .then((res) => {
                    this.loading = false;
                    this.$router.push("/");
                })
                .catch((err) => {
                    this.loading = false;
                    this.$store.commit("clearToken");
                });
        } else {
            this.loading = false;
        }
    },
};
</script>

<style scoped></style>
