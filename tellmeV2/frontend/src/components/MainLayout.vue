<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Modal -->
        <div
            v-show="this.modelOpen"
            class="fixed inset-0 z-50"
            role="dialog"
            aria-modal="true"
        >
            <div
                class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0"
            >
                <div
                    @click="decline"
                    v-show="this.modelOpen"
                    class="fixed h-screen w-full inset-0 flex items-center transition-opacity blur-sm backdrop-blur-sm bg-gray/10"
                    aria-hidden="true"
                ></div>

                <div
                    v-show="this.modelOpen"
                    class="inline-block w-full my-[30vh] max-w-xl overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl"
                >
                    <!-- <div class="flex items-center justify-between space-x-4">
          

            <button
              @click="this.modelOpen = false"
              class="text-red-600 focus:outline-none hover:text-gray-700"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-6 h-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                />
              </svg>
            </button>
          </div> -->

                    <div>
                        <div
                            class="max-h-56  p-5 flex flex-col gap-2 overflow-y-auto"
                        >
                            <div
                                class="flex  flex-col items-center justify-between py-3 rounded w-full sm:flex-row"
                            >
                                <div class="flex gap-3 items-center">
                                    <div
                                        class="h-10 w-10 overflow-hidden rounded-full bg-gray-600"
                                    >
                                        <img
                                            class="h-full w-full object-fit"
                                            :src="caller.avatar"
                                            alt=""
                                        />
                                    </div>
                                    <h3 class="font-medium">
                                     {{ caller.first_name }}   {{ caller.last_name }} is Calling ...
                                    </h3>
                                </div>
                                <div class="flex items-center gap-6">
                                    <button class="p-2 rounded-full bg-red-600">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-6 h-6 text-white"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"
                                            />
                                        </svg>
                                    </button>
                                    <button
                                        class="p-2 rounded-full bg-green-500"
                                        @click="answer"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-6 h-6 text-white"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z"
                                            />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->

        <!-- Side Bar -->
        <SideBar />
        <!-- End Side Bar -->

        <!-- Content -->
        <main class="w-[calc(100%-3.35rem)] ml-auto flex flex-col">
            <router-view></router-view>
        </main>
        <!-- End Content -->
    </div>
</template>

<script>
import SideBar from "./SideBar.vue";
import axios from "axios";
import Swal from "sweetalert2";
export default {
    name: "MainLayout",
    components: {
        SideBar,
    },

    data() {
        return {
            modelOpen: false,
            notif_id: null,
            room_id: null,
            caller : {}
        };
    },
    methods: {
     
        answer() {
            let config = {
                method: "post",
                maxBodyLength: Infinity,
                url: "http://127.0.0.1:8000/api/v1/answerCall",
                data: {
                    id: this.$store.state.user.id,
                    notificationId: this.notif_id,
                },
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    Authorization: `Bearer ${this.$store.state.token}`,
                },
            };
            axios
                .request(config)
                .then((res) => {
                    console.log("Answer Response :", res.data);

                    if (res.data.success) {
                        // console.log("Answer Response :", res.data.latest_unreadNotification.id);
                        // this.notif_id = res.data.latest_unreadNotification.id;
                        this.modelOpen = false;
                        this.$router.push({ path: 'meeting', query: { room: this.room_id } })
                    } else {
                        this.notif_id = null;
                        this.room_id = null;
                        this.modelOpen = false;
                        this.caller = null
                    }
                })
                .catch((err) => {
                    console.log("Notifications error : ", err);
                });
        },
        decline() {
            let config = {
                method: "post",
                maxBodyLength: Infinity,
                url: "http://127.0.0.1:8000/api/v1/answerCall",
                data: {
                    id: this.$store.state.user.id,
                    notificationId: this.notif_id,
                },
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    Authorization: `Bearer ${this.$store.state.token}`,
                },
            };
            axios
                .request(config)
                .then((res) => {
                    console.log("decline Response :", res.data);

                    if (res.data.success) {
                        // console.log("Answer Response :", res.data.latest_unreadNotification.id);
                        // this.notif_id = res.data.latest_unreadNotification.id;
                        this.modelOpen = false;
                        this.notif_id = null;
                        this.room_id = null;
                        this.caller = {}
                    }
                })
                .catch((err) => {
                    console.log("decline error : ", err);
                });
        },
        receiveCalls() {
            let config = {
                method: "post",
                maxBodyLength: Infinity,
                url: "http://127.0.0.1:8000/api/v1/unreadNotification",
                data: { id: this.$store.state.user.id },
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    Authorization: `Bearer ${this.$store.state.token}`,
                },
            };
            axios
                .request(config)
                .then((res) => {
                    console.log("Notifications Response :", res.data);
                    

                    if (res.data.success) {
                        this.notif_id = res.data.latest_unreadNotification.id;
                        this.room_id =
                        res.data.latest_unreadNotification.data.room.id;
                        this.caller =    res.data.latest_unreadNotification.data.sender
                        this.modelOpen = true;
                    } else {
                        this.modelOpen = false;
                        this.notif_id = null;
                        this.room_id = null;
                        this.caller = {};
                    }
                })
                .catch((err) => {
                    console.log("Notifications error : ", err);
                });
        },
    },
    mounted() {
        // if (this.$store.state.token != null) {
        // axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
        this.receiveCalls();
        let config = {
            method: "post",
            maxBodyLength: Infinity,
            url: "http://127.0.0.1:8000/api/v1/checkToken",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                Authorization: `Bearer ${this.$store.state.token}`,
            },
        };
        axios
            .request(config)
            .then((res) => {
                console.log(" Response :", res.data);
                if (res.data.error === "TokenExpired") {
                    Swal.fire({
                        title: "Your session has expired",
                        text: "Please log in again to continue using the app .",
                        confirmButtonText: "login",
                        confirmButtonColor: "#FF4D00",
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            this.$store.commit("clearToken");
                            this.$router.push("/login");
                        } else if (result.isDenied) {
                            location.reload();
                        } else if (result.isDismissed) {
                            location.reload();
                        }
                    });
                }
            })
            .catch((err) => {
                console.log("Errr : ", err);
                this.$store.commit("clearToken");
                this.$router.push("/login");
            });
        // }
        // else {
        //     this.$router.push("/login");
        // }
    },
};
</script>

<style></style>
