import { createRouter, createWebHistory } from "vue-router";
import store from "../store";
import Dashboard from "../views/Dashboard.vue";
import Login from "../views/Login.vue";
import Register from "../views/Register.vue";
import Home from "../views/Home.vue";
import Profile from "../views/profile.vue";
import Streams from "../views/Streams.vue";
import Podcasts from "../views/Podcasts.vue";
import StreamRoom from "../views/StreamRoom.vue";
import Meeting from "../views/Meeting.vue";
import Discover from "../views/Discover.vue";
import ShortVideos from "../views/ShortVideos.vue";
import AdminLayout from "../components/AdminLayout.vue";
import AuthLayout from "../components/AuthLayout.vue";
import MainLayout from "../components/MainLayout.vue";
import Speakers from "../views/Speakers.vue";
import Settings from "../views/Settings.vue";

const routes = [
    {
        path: "/dashboard",
        redirect: "/dashboard",
        component: AdminLayout,
        meta: { requiresAuth: true },
        children: [
            { path: "/dashboard", name: "Dashboard", component: Dashboard },
        ],
    },

    {
        path: "/auth",
        redirect: "/login",
        component: AuthLayout,
        meta: { isGuest: true },
        children: [
            {
                path: "/login",
                name: "login",
                component: Login,
            },
            {
                path: "/register",
                name: "register",
                component: Register,
            },
        ],
    },
    {
        path: "/",
        redirect: "/login",
        component: MainLayout,
        meta: { requiresAuth: true },
        children: [
            {
                path: "/",
                name: "home",
                component: Home,
            },
            {
                path: "/meeting",
                name: "meeting",
                component: Meeting,
            },
            {
                path: "/discover",
                name: "discover",
                component: Discover,
            },
            {
                path: "/streams",
                name: "streams",
                component: Streams,
            },
            {
                path: "/podcasts",
                name: "podcasts",
                component: Podcasts,
            },
            {
                path: "/streamRoom",
                name: "streamRoom",
                component: StreamRoom,
            },

            {
                path: "/shortvideos/create",
                name: "recordvideos",
                component: ShortVideos,
            },
            {
                path: "/speakers",
                name: "Speakers",
                component: Speakers,
            },
            {
                path: "/settings",
                name: "Settings",
                component: Settings,
            },
            {
                path: "/profile",
                name: "profile",
                component: Profile,
            },
        ],
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    if (
        to.meta.requiresAuth &&
        store.state.token === null &&
        store.state.user === null
    ) {
        next({ name: "login" });
    } else if (store.state.token && store.state.user && to.meta.isGuest) {
        next({ name: "home" });
    } else {
        next();
    }
});

export default router;
