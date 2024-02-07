<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ProjectDescriptionComponent from "@/Components/Project/ProjectDescriptionComponent.vue";
import TaskListComponent from "@/Components/Project/TaskListComponent.vue";

const myStatisticHeaders = [
    { title: 'Наименование задачи', key: 'name' },
    { title: 'Затрачено', key: 'my_time_spent' },
];

const allStatisticHeaders = [
    { title: 'Наименование задачи', key: 'name' },
    { title: 'Затрачено', key: 'total_time_spent' },
];

const trackingHeaders = [
    { title: 'Что делал', key: 'name' },
    { title: 'Задача', key: 'task.name' },
    { title: 'Продолжительность', key: 'duration_time' },
    { title: 'Начал', key: 'started_at' },
    { title: 'Закончил', key: 'stopped_at' },
];


</script>

<template>
    <AppLayout title="Мои проекты">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Статистика: / {{ project.name }}
            </h2>
        </template>
        <v-row class="bg-white max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 my-lg-5">
            <v-col>
                <span class="ma-5 text-h6">Моя статистика / всего: {{ mySpentTime }}</span>
                <v-data-table-virtual
                    class="pa-3"
                    :headers="myStatisticHeaders"
                    :items="myTasks"
                    :height="tableMyHeight"
                    item-value="name"
                ></v-data-table-virtual>
            </v-col>
            <v-col>
                <span class="ma-5 text-h6">Общая статистика / всего: {{ totalSpentTime }}</span>
                <v-data-table-virtual
                    class="pa-3"
                    :headers="allStatisticHeaders"
                    :items="allTasks"
                    :height="tableAllHeight"
                    item-value="name"
                ></v-data-table-virtual>
            </v-col>
        </v-row>
        <v-row class="bg-white max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <v-col>
                <span class="ma-5 text-h6">Мои треки по проекту</span>
                <v-data-table-virtual
                    class="pa-3"
                    :headers="trackingHeaders"
                    :items="tracking"
                    item-value="name"
                ></v-data-table-virtual>
            </v-col>
        </v-row>
    </AppLayout>

</template>

<script>
import {usePage} from "@inertiajs/vue3";
export default {
    props: {
        project: Object,
        myTasks: Object,
        allTasks: Object,
        tracking: Object,
        mySpentTime: String,
        totalSpentTime: String,

    },
    computed: {
        tableMyHeight() {
            let num = this.myTasks.length >= 5 ? 5 : this.myTasks.length

            return 56 * (num + 1);
        },
        tableAllHeight() {
            let num = this.allTasks.length >= 5 ? 5 : this.allTasks.length

            return 56 * (num + 1);
        }
    },
}
</script>
