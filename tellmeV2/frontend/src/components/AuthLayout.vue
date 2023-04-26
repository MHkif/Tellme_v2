<template>
    <div class="flex min-h-full items-center">
        <div class="relative hidden w-[40%] h-screen md:flex">
            <div
                class="absolute -top-40 -left-32 rounded-full border border-orange-600 bg-orange-50"
                style="height: 650px; width: 650px"
            ></div>

            <div
                class=" absolute -top-40 -left-32 rounded-full  border border-orange-600 bg-gray-900  flex items-center justify-center"
                style="height: 620px; width: 620px"
            >
            <p class="text-white absolute left-36 top-52">
                Join The Tellme Univers
            </p> 
        </div>
        </div>

      
        <router-view></router-view>

    </div>
</template>

<script>
export default {};
</script>

<style scoped></style>
