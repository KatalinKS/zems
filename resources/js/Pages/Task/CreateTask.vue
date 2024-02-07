<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

</script>


<template>
    <AppLayout title="Создать задачу">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Создать задачу
            </h2>
        </template>
        <v-sheet width="300" class="pa-5 mx-auto my-lg-5">
            <v-text-field
                v-model="name"
                :model-value="name"
                label="Наименование задачи"
                :rules="rules"
            ></v-text-field>
            <v-select
                :items="projects"
                v-model="projectId"
                :item-title="'name'"
                :item-value="'id'"
                label="Проект"
                :rules="rules"
            ></v-select>
            <v-textarea
                v-model="description"
                :model-value="description"
                label="Описание"
                :rules="rules"
            ></v-textarea>
            <v-btn @click="handle">Сохранить</v-btn>
        </v-sheet>

    </AppLayout>
</template>

<script>

export default {
    props: {
        projects: Object,
        selectedProjectId: Number
    },
    data() {
        return {
            projectId: this.selectedProjectId,
            name: null,
            description: null,
            rules: [
                value => {
                    if (value) return true

                    return 'Поле обязательно к заполнению'
                },
            ],

        }
    },
    methods: {
        handle() {

            let data = {
                name: this.name,
                project_id: this.projectId,
                description: this.description,
            }

            axios.put(route('api.task.store'), data)
                .then(response => {
                    if (response.status === 200) {
                        window.location.href = route('projects');
                    }
                });
        }

    }
}

</script>
