<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';

const props = defineProps({
    weather: {
        type: Object,
        default: () => ({})
    }
});

const iconLink = "http://openweathermap.org/img/wn/";

const toDayOfWeek = (timestamp) => {
    const newDate = new Date(timestamp * 1000);
    const days = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"];
    return days[newDate.getDay()];
}
</script>

<template>
    <Head title="Weather" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Weather</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg flex justify-center">
                    <div class="text-white mb-8">
                        <div
                            class="weather-container font-sans md:w-128 max-w-lg rounded-lg overflow-hidden bg-gray-900 shadow-lg mt-8"
                        >
                            <div class="current-weather flex items-center justify-between px-6 py-8">
                                <div class="flex flex-col md:flex-row items-center">
                                    <div>
                                        <div class="text-5xl font-semibold">{{ Math.round(weather.current.temp) }}°C</div>
                                        <div>Feels like {{ Math.round(weather.current.feels_like) }}°C</div>
                                    </div>
                                    <div class="md:mx-5">
                                        <div class="font-semibold">{{ weather.current.weather[0].main }}</div>
                                        <div>{{ weather.current.weather[0].description }}</div>
                                    </div>
                                </div>
                                <div>
                                    <img :src="'http://openweathermap.org/img/wn/' + weather.current.weather[0].icon + '.png'" width="90" height="90" />
                                </div>
                            </div>

                            <div class="future-weather text-sm bg-white text-black px-6 py-8 overflow-hidden">
                                <div
                                    v-for="(day, index) in weather.daily"
                                    :key="day.dt"
                                    class="flex items-center"
                                    :class="{ 'mt-8': index > 0 }"
                                    v-show="index > 0 && index < 8"
                                >
                                    <div class="w-1/6 text-lg text-black font-bold">{{ toDayOfWeek(day.dt) }}</div>
                                    <div class="w-4/6 px-4 flex items-center">
                                        <div>
                                            <img :src="'http://openweathermap.org/img/wn/' + day.weather[0].icon + '.png'" width="70" height="70" />
                                        </div>
                                        <div class="ml-3">{{ day.weather[0].description }}</div>
                                    </div>
                                    <div class="w-1/6 text-right">
                                        <div>{{ Math.round(day.temp.max) }}°C</div>
                                        <div>{{ Math.round(day.temp.min) }}°C</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
