<template>
    <section class="w-full flex flex-col gap-6 p-8">
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
                                            id="podcast"
                                            type="text"
                                            v-model="data.url"
                                            :class="
                                                !urlError
                                                    ? 'border-gray-200'
                                                    : 'border-red-600'
                                            "
                                            class="w-full text-gray-600 placeholder-gray-400 bg-white border rounded focus:border-orange-300 focus:outline-none focus:ring-1 focus:ring-orange-300 focus:ring-opacity-40"
                                        />
                                        {{ data.url }}
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
                                            id="cover"
                                            type="text"
                                            v-model="data.cover"
                                            class="w-full text-gray-600 placeholder-gray-400 bg-white border rounded focus:border-orange-300 focus:outline-none focus:ring-1 focus:ring-orange-300 focus:ring-opacity-40"
                                            :class="
                                                !coverError
                                                    ? 'border-gray-200'
                                                    : 'border-red-600'
                                            "
                                        />
                                        {{ data.cover }}
                                    </div>

                                    <p
                                        v-show="coverError"
                                        id="coverErr"
                                        class="ml-36 mt-1 text-xs text-red-500"
                                    >
                                        Podcast cover is required
                                    </p>
                                </div>
                                <div>
                                    <label
                                        for="playlist"
                                        class="block text-sm text-gray-700 capitalize dark:text-gray-200"
                                        >Playlist
                                        <span class="text-xs"
                                            >(optional)</span
                                        ></label
                                    >
                                    <select
                                        v-model="data.playlist"
                                        id="playlist"
                                        :class="
                                            !playListError
                                                ? 'border-gray-200'
                                                : 'border-red-600'
                                        "
                                        class="block w-full mt-2 text-gray-600 placeholder-gray-400 bg-white border rounded focus:border-orange-300 focus:outline-none focus:ring-1 focus:ring-orange-300 focus:ring-opacity-40"
                                        aria-placeholder="playlist"
                                        aria-label="select a playlist"
                                    >
                                        <option
                                            v-for="playlist in playlists"
                                            :key="playlist.id"
                                            :value="playlist.id"
                                        >
                                            {{ playlist.name }}
                                        </option>
                                    </select>
                                    <p
                                        v-show="playListError"
                                        id="playlistErr"
                                        class="mt-1 text-xs text-red-500"
                                    >
                                        {{ playListError }}
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

        <div class="w-full flex flex-col gap-6" v-if="podcasts.length">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-medium">{{ title }}</h3>
                <Button
                    v-show="route === 'profile'"
                    @click="this.modelOpen = true"
                    class="flex justify-center rounded bg-gray-900 px-4 py-2 text-md font-semibold text-orange-600 border border-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
                >
                    Create Podcast
                </Button>
            </div>
            <div
                class="grid grid-cols sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xxl:grid-cols-5 gap-6"
            >
                <CardPodcast
                    v-for="podcast in podcasts"
                    :key="podcast.id"
                    :podcast="podcast"
                />
            </div>
        </div>

        <section
            v-else
            class="w-full h-[calc(100vh-8rem)] flex items-center justify-center flex-col gap-4 p-8"
        >
            <h3 class="font-bold text-center text-xl text-gray-800">
                No Podcasts has been found, Try to create one .
            </h3>
            <Button
                @click="this.modelOpen = true"
                class="flex justify-center rounded bg-gray-900 px-4 py-2 text-md font-semibold text-orange-600 border border-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
            >
                Create Podcast
            </Button>
        </section>
    </section>
</template>

<script>
// import PodcastCard from "../components/PodcastCard.vue";
import axios from "axios";
import CardPodcast from "./CardPodcast.vue";
import { useRoute } from "vue-router";
export default {
    name: "PodcastsGrid",

    data() {
        return {
            modelOpen: false,
            route: "",
            categories: [],
            playlists: [],
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
    components: {
        // PodcastCard,
        CardPodcast,
    },
    props: {
        podcasts: Array,
        title: String,
    },
    methods: {
        uploadPodcast() {
            myWidget.open();
        },
        uploadCover() {
            widget.open();
        },
        createPodcast() {
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

        myPlaylists() {
            axios
                .get("http://127.0.0.1:8000/api/v1/myPlaylists")
                .then((response) => {
                    console.log("Response Playlists : ", response.data);
                    if (response.data) {
                        this.playlists = response.data;
                    }
                })
                .catch((error) => {
                    console.log("Error Playlists :", error.response);
                });
        },
    },
    mounted() {
        this.route = useRoute().name;
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
        folder: "covers", //upload files to the specified folder
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
            // document
            //   .getElementById("uploadedimage")
            //   .setAttribute("src", result.info.secure_url);
            document.getElementById("cover").value = result.info.secure_url;
            // document.getElementById("cover").innerText = result.info.secure_url;
            // document.getElementById("cover").innerHTML = result.info.secure_url;

            // this.data.cover = result.info.secure_url;
            // console.log("Cover : ", this.data.cover);
            // console.log("Cover : ",this.data.cover)
            // .setAttribute("value", result.info.secure_url);
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
        folder: "audios", //upload files to the specified folder
        // tags: ["users", "profile"], //add the given tags to the uploaded files
        // context: {alt: "user_uploaded"}, //add the given context data to the uploaded files
        clientAllowedFormats: ["mp3"], //restrict uploading to image files only
        // maxImageFileSize: 2000000,  //restrict file size to less than 2MB
        // maxImageWidth: 2000, //Scales the image down to a width of 2000 pixels before uploading
        theme: "orange", //change to a purple theme
    },
    (error, result) => {
        if (!error && result && result.event === "success") {
            localStorage.setItem("podcast", result.info.url);

            console.log(result.info.format);
            console.log("Done! Here is the podcast info: ", result.info.url);
            // document
            //   .getElementById("uploadedAudio")
            //   .setAttribute("src", result.info.secure_url);
            // this.data.url = result.info.secure_url;
            document.getElementById("podcast").innerText =
                result.info.secure_url;
            // document.getElementById("podcast").value = result.info.secure_url;
        }
    }
);
</script>
