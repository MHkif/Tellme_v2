<template>
    <div
        class="z-20 w-full flex flex-col h-screen space-y-8 py-4 px-8 md:w-[60%]"
    >
        <div class="flex items-center justify-end gap-4 w-full">
            <h3 class="block text-md text-gray-600">Not a member ?</h3>
            <router-link
                to="/register"
                class="flex justify-center rounded-md bg-orange-600 px-4 py-2 text-md font-semibold text-white hover:text-orange-600 hover:bg-white border border-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
            >
                Sign Up
            </router-link>
        </div>

        <div class="flex flex-col items-center justify-center h-full space-y-8">
            <div>
                <h2
                    class="mt-6 text-center text-3xl font-medium tracking-tight text-gray-900"
                >
                    Sign in to Tellme Univers
                </h2>
            </div>
            <form class="space-y-4 w-1/2" @submit.prevent="login">
                <input type="hidden" name="remember" value="true" />
                <div class="space-y-4 rounded-md">
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
                                !emailErr
                                    ? 'border-orange-500'
                                    : 'border-red-600 ring-none'
                            "
                            class="relative block w-full rounded-md border py-2.5 text-gray-900 ring-1 ring-outset ring-orange-600 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-orange-600 sm:text-sm sm:leading-6"
                            placeholder="Enter Your Email"
                        />
                        <p
                            v-show="emailErr"
                            id="email_Error"
                            class="mt-1 text-xs text-red-500"
                        >
                            {{ emailErr }}
                        </p>
                    </div>
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
                                !passwordErr
                                    ? 'border-orange-500'
                                    : 'border-red-600  ring-none'
                            "
                            class="relative block w-full rounded-md border py-2.5 text-gray-900 ring-1 ring-outset ring-orange-600 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-orange-600 foucus:border-orange-400 sm:text-sm sm:leading-6"
                            placeholder="Password"
                        />
                        <p
                            v-show="passwordErr"
                            id="password_Error"
                            class="mt-1 text-xs text-red-500"
                        >
                            {{ passwordErr }}
                        </p>
                    </div>
                </div>

                <div class="flex w-full items-center justify-between">
                    <div class="flex items-center">
                        <input
                            id="remember-me"
                            name="remember-me"
                            type="checkbox"
                            class="relative h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"
                        />

                        <label
                            for="remember-me"
                            class="ml-2 block text-sm text-gray-900"
                            >Remember me</label
                        >
                    </div>

                    <div class="text-sm">
                        <a
                            href="#"
                            class="font-medium text-gray-500 hover:text-orange-600"
                            >Forgot your password?</a
                        >
                    </div>
                </div>

                <div>
                    <button
                        type="submit"
                        class="group relative flex w-full justify-center rounded-md bg-orange-600 px-3 py-2.5 text-md font-semibold text-white hover:text-orange-600 hover:bg-white hover:border hover:border-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
                    >
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            credentials: {
                email: "",
                password: "",
            },
            emailErr: "",
            passwordErr: "",
            loading: true,
        };
    },
    methods: {
        login() {
            axios
                .post("http://127.0.0.1:8000/api/v1/login", this.credentials)
                .then((response) => {
                    // localStorage.setItem("id", response.data.user_id);
                    this.$store.commit("setToken", response.data.token);
                    // this.$store.commit("setId", response.data.user_id);
                    this.$store.commit("setUser", response.data.user);

                    console.log("Token : ", response.data);
                    this.$router.push("/home");
                })
                .catch((error) => {
                    console.log("Error : ", error);
                    if (error.response.data.email) {
                        this.emailErr = error.response.data.email[0];
                    } else {
                        this.emailErr = "";
                    }
                    if (error.response.data.password) {
                        this.passwordErr = error.response.data.password[0];
                    } else {
                        this.passwordErr = "";
                    }
                });
        },
    },

    mounted() {
        if (this.$store.state.token != null) {
            axios
                .post("http://127.0.0.1:8000/api/v1/checkToken", {
                    Accept: "application/json",
                    Authorization: `Bearer ${this.$store.state.token}`,
                })
                .then((res) => {
                    this.loading = false;
                    location.reload();
                })
                .catch((err) => {
                    this.loading = false;
                    this.$store.commit("clearToken");
                    this.$router.push("/home");
                });
        }
    },
};
</script>

<style scoped></style>
