<template>
    <div>
        <!-- Navbar -->
        <!-- <NavBar /> -->
        <!-- End Navbar -->
        <!-- Modal -->
        <div v-show="this.modelOpen" class="fixed inset-0 z-50">
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
                            <h3>Create Short Video</h3>
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
                                @submit.prevent="createVideo"
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
                                    <div class="w-full flex gap-4 mt-2">
                                        <div
                                            @click="upload"
                                            class="w-36 flex items-center justify-center text-sm text-gray-700 capitalize rounded bg-gray-900 px-4 py-1.5 font-meduim text-white hover:text-orange-600 border border-white hover:border-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
                                        >
                                            Video File
                                        </div>
                                        <input
                                            id="shortVideo"
                                            type="text"
                                            v-model="data.url"
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
                                        Video file is required
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

        <div
            class="flex w-full h-[calc(100vh)] items-center justify-center p-4"
        >
            <div
                class="flex items-center justify-center relative h-full w-[100%]"
            >
                <video
                    id="video"
                    class="h-full object-cover bg-center w-full bg-gray-900 ring-2 ring-gray-100 rounded-lg shadow-lg"
                    autoplay
                    playsinline
                ></video>
                <div
                    v-show="!recorded"
                    :class="
                        isRecording
                            ? 'bg-red-600 ring-2 ring-white'
                            : 'ring-2 ring-red-600'
                    "
                    class="flex absolute text-white top-4 gap-0.5 items-center justify-center px-2 py-1 rounded"
                >
                    <h2 id="minutes">00</h2>
                    :
                    <h2 id="seconds">00</h2>
                </div>
                <div
                    class="flex absolute bottom-10 items-center justify-center gap-6"
                >
                    <button
                        id="record"
                        @click="recordFunction"
                        :class="
                            !isRecording
                                ? 'bg-red-600 ring-2 ring-white'
                                : 'ring-2 ring-red-600'
                        "
                        class="flex items-center justify-center w-12 h-12 rounded-full shadow-md text-md font-semibold focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            :class="recorded ? 'block' : 'hidden'"
                            class="w-8 h-8 fill-white"
                        >
                            <path
                                d="M12 16c1.671 0 3-1.331 3-3s-1.329-3-3-3-3 1.331-3 3 1.329 3 3 3z"
                            ></path>
                            <path
                                d="M20.817 11.186a8.94 8.94 0 0 0-1.355-3.219 9.053 9.053 0 0 0-2.43-2.43 8.95 8.95 0 0 0-3.219-1.355 9.028 9.028 0 0 0-1.838-.18V2L8 5l3.975 3V6.002c.484-.002.968.044 1.435.14a6.961 6.961 0 0 1 2.502 1.053 7.005 7.005 0 0 1 1.892 1.892A6.967 6.967 0 0 1 19 13a7.032 7.032 0 0 1-.55 2.725 7.11 7.11 0 0 1-.644 1.188 7.2 7.2 0 0 1-.858 1.039 7.028 7.028 0 0 1-3.536 1.907 7.13 7.13 0 0 1-2.822 0 6.961 6.961 0 0 1-2.503-1.054 7.002 7.002 0 0 1-1.89-1.89A6.996 6.996 0 0 1 5 13H3a9.02 9.02 0 0 0 1.539 5.034 9.096 9.096 0 0 0 2.428 2.428A8.95 8.95 0 0 0 12 22a9.09 9.09 0 0 0 1.814-.183 9.014 9.014 0 0 0 3.218-1.355 8.886 8.886 0 0 0 1.331-1.099 9.228 9.228 0 0 0 1.1-1.332A8.952 8.952 0 0 0 21 13a9.09 9.09 0 0 0-.183-1.814z"
                            ></path>
                        </svg>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            :class="isRecording ? 'block' : 'hidden'"
                            class="w-8 h-8 fill-black"
                        >
                            <path
                                d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"
                            ></path>
                            <path d="M13 9h2v6h-2zM9 9h2v6H9z"></path>
                        </svg>
                    </button>
                    <!-- 
                    <button
                        :class="recorded ? 'block' : 'hidden'"
                        id="playButton"
                        @click="play"
                        class="flex items-center justify-center w-16 h-16 rounded-full shadow-md text-md font-semibold ring-1 ring-red-600 hover:ring-orange-600 bg-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            class="w-10 h-10 fill-white"
                        >
                            <path
                                d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"
                            ></path>
                            <path d="m9 17 8-5-8-5z"></path>
                        </svg>
                    </button> -->

                    <a
                        href="#"
                        id="download"
                        v-show="!saved"
                        @click="save"
                        :class="recorded ? 'block' : 'hidden'"
                        class="flex items-center justify-center w-12 h-12 rounded-full shadow-md text-md font-semibold ring-1 ring-red-600 hover:ring-orange-600 bg-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            class="w-8 h-8 fill-white"
                        >
                            <path
                                d="M18.944 11.112C18.507 7.67 15.56 5 12 5 9.244 5 6.85 6.61 5.757 9.149 3.609 9.792 2 11.82 2 14c0 2.657 2.089 4.815 4.708 4.971V19H17.99v-.003L18 19c2.206 0 4-1.794 4-4a4.008 4.008 0 0 0-3.056-3.888zM8 12h3V9h2v3h3l-4 5-4-5z"
                            ></path>
                        </svg>
                    </a>

                    <!-- <button
        
          @click="play"
          disabled
          class="flex justify-center rounded-full bg-white shadow-md px-4 py-2 text-md font-semibold disabled:text-white text-black ring-1 disabled:ring-white ring-black hover:bg-black hover:text-orange-600 disabled:bg-gray-100 hover:ring-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
        >
          Play
        </button> -->

                    <!-- <a
          href="#"
          id="download"
          @click="save"
          class="flex justify-center rounded-full shadow-md bg-red-600 px-4 py-2 text-md font-semibold text-white hover:text-red-600 ring-1 ring-white disabled:bg-gray-100 hover:ring-red-600 hover:bg-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
        >
          Downlaod
        </a> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import NavBar from "../components/NavBar.vue";
import MainLayout from "../components/MainLayout.vue";
import axios from "axios";

export default {
    components: {
        MainLayout,
        NavBar,
    },
    name: "ShortVideos",
    data() {
        return {
            modelOpen: false,
            mediaRecorder: "",
            theRecorder: "",
            recordedChunks: [],
            categories: [],
            isRecording: false,
            recorded: false,
            saved: false,
            isPlaying: false,
            data: {
                user_id: this.$store.state.id,
                title: "",
                category_id: "",
                url: "",
                duration: "1:20",
            },
            error: "",
            urlError: "",
            titleError: "",
            catyError: "",
        };
    },

    methods: {
        uploadVideo() {
            widget.open();
        },
        generateName(length) {
            let characters =
                "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            let result = " ";
            const charactersLength = characters.length;
            for (let i = 0; i < length; i++) {
                result += characters.charAt(
                    Math.floor(Math.random() * charactersLength)
                );
            }

            return result;
        },

        async init() {
            this.recorded = false;
            this.isRecording = true;
            document.querySelector("video").innerHTML = null;

            await navigator.mediaDevices
                .getUserMedia({
                    video: {
                        width: { min: 640, ideal: 1920, max: 1920 },
                        height: { min: 480, ideal: 1080, max: 1080 },
                    },
                    audio: {},
                })
                .then(this.accessMedia)
                .catch((e) => {
                    console.error("getUserMedia() failed: " + e);

                    this.isRecording = false;
                    // Explain why you need permission and how to update the permission setting
                    // alert("PERMISSION DENIED");
                    // location.reload();
                });
            // document.getElementById("video").srcObject = this.localStream;
        },
        accessMedia(stream) {
            var timer;
            let minutesEle = document.getElementById("minutes");
            let secondsEle = document.getElementById("seconds");
            let minutes = 0;
            let seconds = 0;
            this.mediaRecorder = stream;
            var video = document.querySelector("video");
            video.srcObject = stream;
            var recorder = new MediaRecorder(stream, {
                mimeType: "video/webm",
            });
            this.theRecorder = recorder;
            recorder.ondataavailable = (e) => {
                this.recordedChunks.push(e.data);
            };
            recorder.start(100);
            this.recorded = false;
            timer = setInterval(() => {
                // minutes === 1 && seconds === 3
                if (seconds === 10) {
                    clearInterval(timer);
                    this.recordFunction();
                }

                if (seconds < 10) {
                    secondsEle.innerHTML = "0" + seconds;
                } else {
                    secondsEle.innerHTML = seconds;
                }
                if (minutes) {
                    minutesEle.innerHTML = "0" + minutes;
                }
                seconds++;
                if (seconds === 60) {
                    seconds = 0;
                    minutes++;
                }
            }, 1000);
        },

        recordFunction() {
            if (!this.isRecording) {
                this.isRecording = true;
                if (this.recorded) {
                    var recordedVideo = document.getElementById("video");

                    recordedVideo.src = null;
                    recordedVideo.srcObject = null;
                    recordedVideo.controls = false;
                    this.init();
                } else {
                    this.init();
                }
            } else if (this.theRecorder) {
                this.isRecording = false;
                this.stopRecording();
            } else {
                alert("Somthing wrong");
            }
        },

        // startRecording() {
        //   this.recordedChunks = [];
        //   this.mediaRecorder.start();
        //   document.getElementById("playCotroller").disabled = false;

        //   console.log("Recording is Started :", this.mediaRecorder);
        // },

        stopRecording() {
            this.theRecorder.stop();
            this.mediaRecorder.getTracks().forEach((track) => track.stop());
            console.log("Recording is Stopped :", this.theRecorder);
            console.log("Recording is :", this.mediaRecorder.state);
            document.querySelector("video").innerHTML = null;
            var recordedVideo = document.getElementById("video");
            // document.getElementById("playButton").disabled = false;
            const videoBlob = new Blob(this.recordedChunks, {
                type: "video/webm",
            });
            const videoUrl = URL.createObjectURL(videoBlob);
            recordedVideo.src = null;
            recordedVideo.srcObject = null;
            console.log("test ", videoUrl);
            recordedVideo.src = videoUrl;
            recordedVideo.controls = true;
            this.recorded = true;
        },

        save() {
            this.isRecording = false;
            this.recorded = false;
            var recordedVideo = document.querySelector("video");
            var downloadAnchor = document.getElementById("download");
            downloadAnchor.href = recordedVideo.src;
            let fileName = this.generateName(8);

            downloadAnchor.download = fileName + ".webm";
            recordedVideo.src = null;
            recordedVideo.srcObject = null;
            recordedVideo.controls = false;
            this.modelOpen = true;
            this.saved = true;
            document.getElementById("minutes").innerHTML = "00";
            document.getElementById("seconds").innerHTML = "00";
        },

        play() {
            var recordedVideo = document.querySelector("video");
            const videoBlob = new Blob(this.recordedChunks, {
                type: "video/webm",
            });
            const videoUrl = URL.createObjectURL(videoBlob);
            recordedVideo.src = null;
            recordedVideo.srcObject = null;
            console.log("test ", videoUrl);
            recordedVideo.src = videoUrl;
            recordedVideo.controls = false;

            recordedVideo.play();
        },

        pause() {
            this.theRecorder.stop();
        },
        playVideo() {
            this.theRecorder.play();
        },

        upload() {
            widget.open();
        },

        createVideo() {
            let config = {
                method: "post",
                maxBodyLength: Infinity,
                url: "http://127.0.0.1:8000/api/v1/shortvideos",
                
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

                    if (error.response.data.errors.title) {
                        this.titleError = error.response.data.errors.title[0];
                    } else {
                        this.titleError = "";
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
    },

    mounted() {
        this.getCategories();
        // this.init();
    },
};

const cloudName = "dr2ly0dd5";
const widget = window.cloudinary.createUploadWidget(
    {
        cloudName: cloudName,
        uploadPreset: "fdswq0tv",
        cropping: true, //add a cropping step
        // showAdvancedOptions: true,  //add advanced options (public_id and tag)
        // sources: [ "local", "url"], // restrict the upload sources to URL and local files
        // multiple: false,  //restrict upload to a single file
        folder: "shortvideos", //upload files to the specified folder
        // tags: ["users", "profile"], //add the given tags to the uploaded files
        // context: {alt: "user_uploaded"}, //add the given context data to the uploaded files
        clientAllowedFormats: ["mp4", "webm"], //restrict uploading to image files only
        // maxImageFileSize: 2000000,  //restrict file size to less than 2MB
        // maxImageWidth: 2000, //Scales the image down to a width of 2000 pixels before uploading
        theme: "orange", //change to a purple theme
    },
    (error, result) => {
        if (!error && result && result.event === "success") {
            console.log("Error : ", error);
            console.log(result);
            console.log("Done! Here is the Video info: ", result.info.url);
            // document
            //   .getElementById("uploadedimage")
            //   .setAttribute("src", result.info.secure_url);
            document.getElementById("shortVideo").value =
                result.info.secure_url;
            // document.getElementById("cover").innerText = result.info.secure_url;
            // document.getElementById("cover").innerHTML = result.info.secure_url;

            // this.data.cover = result.info.secure_url;
            // console.log("Cover : ", this.data.cover);
            // console.log("Cover : ",this.data.cover)
            // .setAttribute("value", result.info.secure_url);
        }
    }
);
</script>

<style scoped>
/* #video {
  width: 100%;
} */
</style>
