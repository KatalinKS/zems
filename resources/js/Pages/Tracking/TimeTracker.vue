<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import TrackingBar from '@/Pages/Tracking/Partials/TrackingBar.vue';
import {usePage} from "@inertiajs/vue3";
import trackingBar from "@/Pages/Tracking/Partials/TrackingBar.vue";

defineProps({
    tasks: Object,
    tracking: Object,
    activeTracking: Object,
})

const headers = []

</script>

<template>
    <AppLayout title="Трекер времени">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Трекинг
            </h2>
        </template>
                <TrackingBar
                    :tasks="tasks"
                    :activeTracking="activeTracking"
                    @freshTracking="freshTracking"
                ></TrackingBar>

        <v-row class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 my-lg-5">
            <v-col>
                <v-data-table
                    :items="tracking"
                    :headers="headers"
                >
                    <template v-slot:item="row">
                        <tr>
                            <td>{{ row.item.name }}</td>
                            <td>{{ row.item.task?.name }}</td>
                            <td>{{ row.item.started_at.slice(-8) }} - {{ row.item.stopped_at.slice(-8) }}</td>
                            <td class="text-center">{{ row.item.duration_time }}</td>
                        </tr>
                    </template>
                </v-data-table>
            </v-col>
        </v-row>
    </AppLayout>

</template>

<script>
import {usePage} from "@inertiajs/vue3";

export default {
    methods: {
        freshTracking() {
            axios.get(route('api.tracking')).then(it => {if(it.status === 200) {
                usePage().props.tracking = it.data.data;
            }});
        }

    }
}
</script>
