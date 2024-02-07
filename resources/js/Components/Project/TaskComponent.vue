<script setup>
    const headers = [
        { title: 'Что делал', key: 'name' },
        { title: 'Потратил времени', key: 'duration_time' },
        { title: 'Начал', key: 'started_at' },
        { title: 'Закончил', key: 'stopped_at' },
    ]
</script>
<template>
    <v-card class="ma-5">
        <v-card-title> {{ task.name }}<span class="text-grey ma-1">Затрачено: {{ task.my_time_spent }}</span></v-card-title>
        <v-card-text>
            <v-row>
                <v-col>
                    <span v-if="hasActiveTracking === false"><a class="underline" @click="startTrackingTask">Начать трекинг</a> / </span>
                    <a class="underline" :href="route('task.edit', {task: task.id})">Изменить задание</a> /
                    <a class="underline" @click="deleteTask">Удалить задание</a>
                </v-col>
            </v-row>
            <v-row>
                <v-col>
                    <span class="text-subtitle-1">Описание задачи:</span><br>
                    {{ task.description }}
                </v-col>
            </v-row>
            <v-row v-if="task.my_tracking.length > 0">
                <v-col>
                    <span class="text-subtitle-1">Мои отслеживания по задаче:</span>
                    <v-data-table-virtual
                        :headers="headers"
                        :items="task.my_tracking"
                        :height="tableHeight"
                    ></v-data-table-virtual>
                </v-col>
            </v-row>

        </v-card-text>
    </v-card>
</template>

<script>
export default {
    props: {
        task: Object,
        hasActiveTracking: Boolean
    },
    computed: {
        tableHeight() {
            let num = this.task.my_tracking.length >= 3 ? 3 : this.task.my_tracking.length

            return 56 * (num + 1);
        }
    },
    methods: {
        startTrackingTask() {

            let data = {
                task_id: this.task.id,
                name: this.task.name,
            }

            axios.post(route('api.tracking.start'), data)
                .then(response => {
                        if (response.status === 200) {
                            window.location.href = route('time_tracker')
                        }
                    }
                );
        },
        deleteTask() {
            axios.delete(route('api.task.destroy', {task: this.task.id}))
                .then(response => {
                        if (response.status === 200) {
                            this.$emit('deletedTask')
                        }
                    }
                );
        }
    }
}
</script>
