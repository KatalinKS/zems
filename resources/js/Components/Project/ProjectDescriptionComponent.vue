<template>
    <v-card class="ma-1">
        <v-card-title>
            Описание проекта
        </v-card-title>
        <v-card-text>
            <v-row>
                <v-col>
                    <a class="underline" :href="route('project.statistic', {project: project.id})">Статистика</a> /
                    <a class="underline" :href="route('task.add', {project: project.id})">Добавить таск</a> /
                    <a class="underline" :href="route('project.edit', {project: project.id})">Изменить проект</a> /
                    <a class="underline" @click="deleteProject">Удалить проект</a>
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    {{ project.description }}
                </v-col>
            </v-row>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    props: {
      project: Object
    },
    methods: {
        deleteProject() {
            axios.delete(route('api.project.destroy', {project: this.project.id})).then(response => {
                if (response.status) {
                    this.$emit('projectDeleted')
                }
            })
        }
    }
}
</script>

