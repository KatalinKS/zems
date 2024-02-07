<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ProjectDescriptionComponent from "@/Components/Project/ProjectDescriptionComponent.vue";
import TaskListComponent from "@/Components/Project/TaskListComponent.vue";

defineProps({
    projects: Object,
    hasActiveTracking: Boolean
})

const headers = [
    { title: 'ID', key: 'id' },
    { title: 'Наименование проекта', key: 'name' },
    { title: 'Создан', key: 'created_at' },
]

</script>

<template>
    <AppLayout title="Мои проекты">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Мои проекты / <a class="underline" :href="route('project.create')">Добавить</a>
            </h2>
        </template>
        <v-expansion-panels  class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 my-lg-0">
            <v-data-iterator class="w-100" :items="projects" items-per-page="-1" slot="12">
                <template v-slot:default="{ items }">
                    <template
                        v-for="(item, i) in items"
                        :key="i"
                    >
                        <v-expansion-panel>
                            <v-expansion-panel-title>
                                    {{ item.raw.name }} <span class="text-grey ma-1">задач: {{ item.raw.tasks.length }}</span>
                            </v-expansion-panel-title>

                            <v-expansion-panel-text class="bg-gray-100">
                                <ProjectDescriptionComponent
                                    @projectDeleted="freshProjects"
                                    :project="item.raw">
                                </ProjectDescriptionComponent>

                                <task-list-component
                                    :key="taskComponentKey"
                                    @freshProjects="freshProjects"
                                    :has-active-tracking = "hasActiveTracking"
                                    :tasks="item.raw.tasks"
                                ></task-list-component>
                            </v-expansion-panel-text>

                        </v-expansion-panel>
                    </template>
                </template>
            </v-data-iterator>
        </v-expansion-panels>
    </AppLayout>

</template>

<script>
import {usePage} from "@inertiajs/vue3";
export default {
    methods: {
        freshProjects() {
            axios.get(route('api.project.index')).then(response => {
                if (response.status === 200) {
                    usePage().props.projects = response.data.data;
                }
            })
        }
    }
}
</script>
