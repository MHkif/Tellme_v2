<template>
    <div>
        <!-- Modal -->
        <div
            v-show="this.modelOpen"
            class="fixed inset-0 z-50"
            aria-labelledby="modal-title"
            role="dialog"
            aria-modal="true"
        >
            <div
                class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0"
            >
                <div
                    @click="this.modelOpen = false"
                    v-show="this.modelOpen"
                    class="fixed w-full inset-0 flex items-center transition-opacity backdrop-blur-sm bg-gray/50"
                    aria-hidden="true"
                ></div>

                <div
                    v-show="this.modelOpen"
                    class="inline-block w-full my-[2vh] max-w-xl overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl"
                >
                    <div>
                        <div
                            class="flex justify-between items-center rounded-t bg-gray-900 px-4 py-3 font-medium text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
                        >
                            <h3>Create Podcast</h3>
                            <button @click="modelOpen = false">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-6 h-6 text-red-600"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                            </button>
                        </div>
                        <div
                            class="max-h-[88vh] py-3 px-5 flex flex-col overflow-y-auto"
                        >
                            <form
                                class="mt-2 flex flex-col gap-4"
                                @submit.prevent="createPodcast"
                            >
                                <div>
                                    <label
                                        for="title"
                                        :class="
                                            error == ''
                                                ? 'border-gray-200'
                                                : error
                                        "
                                        class="block text-sm text-gray-700 capitalize dark:text-gray-200"
                                        >Title</label
                                    >
                                    <input
                                        placeholder="Aliens Homies"
                                        type="text"
                                        v-model="data.title"
                                        name="title"
                                        :class="
                                            !titleError
                                                ? 'border-gray-200'
                                                : 'border-red-600 '
                                        "
                                        class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border rounded focus:border-orange-300 focus:outline-none focus:ring-1 focus:ring-orange-300 focus:ring-opacity-40"
                                    />
                                    <p
                                        v-show="titleError"
                                        id="titleErr"
                                        class="mt-1 text-xs text-red-500"
                                    >
                                        {{ titleError }}
                                    </p>
                                </div>
                                <div>
                                    <label
                                        for="category"
                                        class="block text-sm text-gray-700 capitalize dark:text-gray-200"
                                        >Category</label
                                    >
                                    <select
                                        v-model="data.category_id"
                                        id="category"
                                        :class="
                                            !catyError
                                                ? 'border-gray-200'
                                                : 'border-red-600  '
                                        "
                                        class="block w-full mt-2 text-gray-600 placeholder-gray-400 bg-white border rounded focus:border-orange-300 focus:outline-none focus:ring-1 focus:ring-orange-300 focus:ring-opacity-40"
                                        aria-placeholder="category"
                                        placeholder="Category"
                                        aria-label="select a category"
                                    >
                                        <option
                                            v-for="category in categories"
                                            :key="category.id"
                                            :value="category.id"
                                        >
                                            {{ category.name }}
                                        </option>
                                    </select>
                                    <p
                                        v-show="catyError"
                                        id="categoryErr"
                                        class="mt-1 text-xs text-red-500"
                                    >
                                        {{ catyError }}
                                    </p>
                                </div>
                                <div>
                                    <label
                                        for="description"
                                        class="block text-sm text-gray-700 capitalize dark:text-gray-200"
                                        >Description</label
                                    >
                                    <textarea
                                        :class="
                                            !descError
                                                ? 'border-gray-200'
                                                : 'border-red-600  '
                                        "
                                        class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40"
                                        v-model="data.description"
                                        id="description"
                                        cols="30"
                                        rows="2"
                                        placeholder="Once Upon a time ..."
                                    ></textarea>
                                    <p
                                        v-show="descError"
                                        id="descriptionErr"
                                        class="mt-1 text-xs text-red-500"
                                    >
                                        {{ descError }}
                                    </p>
                                </div>
                                <div>
                                    <div class="w-full flex gap-4 mt-2">
                                        <div
                                            @click="uploadPodcast"
                                            class="w-36 flex items-center justify-center text-sm text-gray-700 capitalize rounded bg-gray-900 px-4 py-1.5 font-meduim text-white hover:text-orange-600 border border-white hover:border-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
                                        >
                                            Podcast File
                                        </div>
                                        <input
                                            id="podcastText"
                                            type="text"
                                            :class="
                                                !urlError
                                                    ? 'border-gray-200'
                                                    : 'border-red-600'
                                            "
                                            class="w-full text-gray-600 placeholder-gray-400 bg-white border rounded focus:border-orange-300 focus:outline-none focus:ring-1 focus:ring-orange-300 focus:ring-opacity-40"
                                        />
                                    </div>
                                    <p
                                        v-show="urlError"
                                        id="podcastErr"
                                        class="ml-36 mt-1 text-xs text-red-500"
                                    >
                                        Podcast file is required
                                    </p>
                                </div>
                                <div>
                                    <div class="w-full flex gap-4">
                                        <div
                                            @click="uploadCover"
                                            class="w-36 flex items-center justify-center text-sm text-gray-700 capitalize rounded bg-gray-900 px-4 py-1.5 font-meduim text-white hover:text-orange-600 border border-white hover:border-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
                                        >
                                            Cover File
                                        </div>

                                        <input
                                            id="coverText"
                                            type="text"
                                            class="w-full text-gray-600 placeholder-gray-400 bg-white border rounded focus:border-orange-300 focus:outline-none focus:ring-1 focus:ring-orange-300 focus:ring-opacity-40"
                                            :class="
                                                !coverError
                                                    ? 'border-gray-200'
                                                    : 'border-red-600'
                                            "
                                        />
                                    </div>

                                    <p
                                        v-show="coverError"
                                        id="coverErr"
                                        class="ml-36 mt-1 text-xs text-red-500"
                                    >
                                        Podcast cover is required
                                    </p>
                                </div>

                                <div class="flex justify-end mt-3">
                                    <button
                                        type="submit"
                                        class="flex justify-center rounded bg-orange-600 px-4 py-2 text-md font-semibold text-white hover:text-orange-600 border border-white hover:border-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
                                    >
                                        Create
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->
        <!-- Navbar -->
        <NavBar />
        <!-- End Navbar -->

        <!-- Cover Section -->
        <CoverProfile :user="user" />
        <!-- End Cover Section -->

        <!-- About Me Section -->
        <section class="w-full flex flex-col gap-6 p-8 md:flex-row">
            <!-- Experiences & About me -->
            <div class="w-full flex flex-col gap-6 md:w-[60%]">
                <AboutMe></AboutMe>
            </div>

            <!-- Location, website , email ... -->
            <div class="w-full flex flex-col gap-6 md:w-[40%]">
                <div class="w-full p-4 rounded-md bg-gray-100">
                    <h3 class="text-black font-medium">Location</h3>
                    <div class="py-2">
                        <h3 class="text-gray-700 font-semiBold">
                            Casablanca, Morocco .
                        </h3>
                    </div>
                </div>
                <div class="w-full p-4 rounded-md bg-gray-100">
                    <h3 class="text-black font-medium">Website</h3>
                    <div class="py-2">
                        <h3 class="text-gray-700 font-semiBold">
                            www.frankdeveone.dev
                        </h3>
                    </div>
                </div>
                <div class="w-full p-4 rounded-md bg-gray-100">
                    <h3 class="text-black font-medium">Email</h3>
                    <div class="py-2">
                        <h3 class="text-gray-700 font-semiBold">
                            frank@gmail.com
                        </h3>
                    </div>
                </div>
            </div>
        </section>
        <!-- End About Me Section -->

        <!--  Playlist Section -->
        <!-- <ListScroll v-if="playlists.length" title="Your Playlists">
            <PlayListCard
                v-for="playlist in playlists"
                :key="playlist.id"
                :playlist="playlist"
            />
        </ListScroll>
        <section
            v-else
            class="w-full flex items-center justify-center flex-col gap-4 p-8"
        >
            <h3 class="font-bold text-center text-xl text-gray-800">
                No Playlists in your channel, Try to create one .
            </h3>
            <Button
                @click="this.modelOpen = true"
                class="flex justify-center rounded bg-gray-900 px-4 py-2 text-md font-semibold text-orange-600 border border-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
            >
                Create PlayList
            </Button>
        </section> -->
        <!-- End  Playlist Section -->

        <!--  Podcasts  Section -->
        <PodcastsGrid
            v-if="podcasts.length"
            title="Your Podcasts"
            :podcasts="podcasts"
            @click="this.$emit('playPodcast', podcast)"
        >
        </PodcastsGrid>
        <!-- End  Podcasts  Section -->
        <section
            v-else
            class="w-full flex items-center justify-center flex-col gap-4 p-8"
        >
            <h3 class="font-bold text-center text-xl text-gray-800">
                No Podcasts in your channel, Try to upload one .
            </h3>
            <Button
                @click="this.modelOpen = true"
                class="flex justify-center rounded bg-gray-900 px-4 py-2 text-md font-semibold text-orange-600 border border-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
            >
                Create Podcast
            </Button>
        </section>
        <div class="my-16"></div>
    </div>
</template>

<script>
import NavBar from "../components/NavBar.vue";
import SideBar from "../components/SideBar.vue";
import CoverProfile from "../components/CoverProfile.vue";
import PodcastCard from "../components/PodcastCard.vue";
import PodcastsGrid from "../components/PodcastsGrid.vue";
import PlayListCard from "../components/PlayListCard.vue";
import ListScroll from "../components/ListScroll.vue";
import MainLayout from "../components/MainLayout.vue";
import AboutMe from "../components/AboutMe.vue";
import axios from "axios";
export default {
    components: {
        MainLayout,
        NavBar,
        SideBar,
        CoverProfile,
        PodcastCard,
        PodcastsGrid,
        PlayListCard,
        ListScroll,
        AboutMe,
    },
    data() {
        return {
            user: {},
            loading: true,
            podcasts: [],
            playlists: [],
            podcast: this.$store.state.podcasts,
            modelOpen: false,
            categories: [],
            data: {
                user_id: this.$store.state.id,
                title: "",
                description: "",
                category_id: "",
                url: "",
                cover: "",
                duration: "20",
            },
            error: "",
            urlError: "",
            coverError: "",
            titleError: "",
            descError: "",
            playListError: "",
            catyError: "",
        };
    },
    methods: {
        uploadPodcast() {
            myWidget.open();
        },
        uploadCover() {
            widget.open();
        },
        createPodcast() {
            this.data.url = localStorage.getItem("podcastUrl");
            this.data.cover = localStorage.getItem("coverUrl");
            console.log("Data  : ", this.data);
            let config = {
                method: "post",
                maxBodyLength: Infinity,
                url: "http://127.0.0.1:8000/api/v1/podcasts",
                data: this.data,
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    Authorization: `Bearer ${this.$store.state.token}`,
                },
            };
            axios
                .request(config)
                .then((response) => {
                    console.log("Response Data : ", response.data);
                    if (response.data.created === true) {
                        location.reload();
                    }
                })
                .catch((error) => {
                    console.log("Error :", error.response);

                    if (error.response.data.errors.url) {
                        this.urlError = error.response.data.errors.url[0];
                    } else {
                        this.urlError = "";
                    }
                    if (error.response.data.errors.cover) {
                        this.coverError = error.response.data.errors.cover[0];
                    } else {
                        this.coverError = "";
                    }
                    if (error.response.data.errors.title) {
                        this.titleError = error.response.data.errors.title[0];
                    } else {
                        this.titleError = "";
                    }
                    if (error.response.data.errors.description) {
                        this.descError =
                            error.response.data.errors.description[0];
                    } else {
                        this.descError = "";
                    }
                    if (error.response.data.errors.category_id) {
                        this.catyError =
                            error.response.data.errors.category_id[0];
                    } else {
                        this.catyError = "";
                    }
                });
        },
        myPodcasts() {
            let config = {
                method: "post",
                maxBodyLength: Infinity,
                url: "http://127.0.0.1:8000/api/v1/mypodcasts",
                data: { user_id: this.$store.state.id },
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    Authorization: `Bearer ${this.$store.state.token}`,
                },
            };
            axios
                .request(config)

                .then((response) => {
                    console.log("Response My Podcasts : ", response);
                    if (response.data) {
                        this.podcasts = response.data.data;
                    }
                })
                .catch((error) => {
                    console.log("Error My Podcasts:", error.response);
                });
        },

        getPlayList() {
            let config = {
                method: "post",
                maxBodyLength: Infinity,
                url: "http://127.0.0.1:8000/api/v1/myplaylists",
                data: { user_id: this.$store.state.id },
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    Authorization: `Bearer ${this.$store.state.token}`,
                },
            };
            axios
                .request(config)

                .then((response) => {
                    console.log("Response My PlayLists : ", response);
                    if (response.data) {
                        this.playlists = response.data.data;
                    }
                })
                .catch((error) => {
                    console.log("Error My PlayLists:", error.response);
                });
        },
        getCategories() {
            let config = {
                method: "get",
                url: "http://127.0.0.1:8000/api/v1/categories",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    Authorization: `Bearer ${this.$store.state.token}`,
                },
            };
            axios
                .request(config)
                .then((response) => {
                    console.log("Response Categories : ", response.data);
                    if (response.data) {
                        this.categories = response.data;
                    }
                })
                .catch((error) => {
                    console.log("Error Categories :", error.response);
                });
        },
    },
    mounted() {
        this.user = this.$store.state.user;
        this.myPodcasts();
        this.getPlayList();
        this.getCategories();
    },
};

const cloudName = "dr2ly0dd5"; // replace with your own cloud name

const widget = window.cloudinary.createUploadWidget(
    {
        cloudName: cloudName,
        uploadPreset: "vrglkscf",
        cropping: true, //add a cropping step
        // showAdvancedOptions: true,  //add advanced options (public_id and tag)
        // sources: [ "local", "url"], // restrict the upload sources to URL and local files
        // multiple: false,  //restrict upload to a single file
        folder: "Covers", //upload files to the specified folder
        // tags: ["users", "profile"], //add the given tags to the uploaded files
        // context: {alt: "user_uploaded"}, //add the given context data to the uploaded files
        clientAllowedFormats: ["jpg", "png", "jpeg", "gpng"], //restrict uploading to image files only
        // maxImageFileSize: 2000000,  //restrict file size to less than 2MB
        // maxImageWidth: 2000, //Scales the image down to a width of 2000 pixels before uploading
        theme: "orange", //change to a purple theme
    },
    (error, result) => {
        if (!error && result && result.event === "success") {
            console.log("Error : ", error);
            console.log(result);
            console.log("Done! Here is the Cover info: ", result.info.url);
            localStorage.setItem("coverUrl", result.info.url);

            document.getElementById("coverText").value = result.info.secure_url;
        }
    }
);

const myWidget = window.cloudinary.createUploadWidget(
    {
        cloudName: cloudName,
        uploadPreset: "yd12wypw",
        // cropping: true, //add a cropping step
        // showAdvancedOptions: true,  //add advanced options (public_id and tag)
        // sources: [ "local", "url"], // restrict the upload sources to URL and local files
        // multiple: false,  //restrict upload to a single file
        folder: "Audios", //upload files to the specified folder
        // tags: ["users", "profile"], //add the given tags to the uploaded files
        // context: {alt: "user_uploaded"}, //add the given context data to the uploaded files
        clientAllowedFormats: ["mp3"], //restrict uploading to image files only
        // maxImageFileSize: 2000000,  //restrict file size to less than 2MB
        // maxImageWidth: 2000, //Scales the image down to a width of 2000 pixels before uploading
        theme: "orange", //change to a purple theme
    },
    (error, result) => {
        if (!error && result && result.event === "success") {
            localStorage.setItem("podcastUrl", result.info.url);

            console.log(result.info.format);
            console.log("Done! Here is the podcast info: ", result.info.url);
            // document
            //   .getElementById("uploadedAudio")
            //   .setAttribute("src", result.info.secure_url);
            // this.data.url = result.info.secure_url;
            document.getElementById("podcastText").value =
                result.info.secure_url;
            // document.getElementById("podcast").value = result.info.secure_url;
        }
    }
);
</script>

<style></style>
