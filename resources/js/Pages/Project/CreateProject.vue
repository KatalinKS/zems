<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

</script>


<template>
    <AppLayout title="Изменение таска">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Изменение проекта
            </h2>
        </template>
        <v-sheet width="300" class="pa-5 mx-auto my-lg-5">
                <v-text-field
                    v-model="name"
                    :model-value="name"
                    label="Наименование проекта"
                    :rules="rules"
                ></v-text-field>
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
    data() {
        return {
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
                description: this.description,
            }

            axios.post(route('api.project.store'), data)
                .then(response => {
                    if (response.status === 200) {
                        window.location.href = route('projects');
                    }
                });
        }

    }
}

</script>
