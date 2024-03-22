<template>
    <section class="intro">
        <div class="bg-image">
            <div class="mask d-flex align-items-center">
                <scheduleCard :modalOpen="modalOpen" @closeModal="closeModal" :scheduleData="schedule"
                    :editingScheduleId="ScheduleId" @save-schedule="SaveSchedule" :erroInput="erroInput" />
                <div class="container">
                    <h1 class="text-center">Agenda</h1>
                    <div class="row justify-content-center mt-3">
                        <div class="col-12">
                            <div class="card shadow-2-strong" style="background-color: #f5f7fa;">
                                <div class="card-body">
                                    <button type="button"
                                        class="btn btn-primary position-absolute top-0 end-0 mt-3 me-3"
                                        @click="openModal">
                                        Novo
                                    </button>
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nome</th>
                                                    <th scope="col">Endereço</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col" class="d-none d-md-table-cell">Telefone</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="schedule in schedules" :key="schedule.id">
                                                    <td class="text-left">{{ schedule.name }}</td>
                                                    <td class="text-left">{{ schedule.andress }}</td>
                                                    <td class="text-left">{{ schedule.email }}</td>
                                                    <td class="text-left d-none d-md-table-cell">{{ schedule.telephone
                                                        }}
                                                    </td>
                                                    <td class="text-right">
                                                        <button type="button" @click="removeSchedule(schedule.id)"
                                                            class="btn btn-danger btn-sm px-3 me-1">
                                                            <i class="ri-close-circle-line"></i>
                                                        </button>
                                                        <button type="button" @click="editSchedule(schedule.id)"
                                                            class="btn btn-warning btn-sm px-3">
                                                            <i class="ri-edit-line"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p v-if="!this.schedules[0]" class="text-center">
                                            Nenhum produto cadastrado.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <Footer />
</template>

<script lang="js">
import { defineComponent, onMounted, ref } from 'vue';
import axiosApi from '../plugin/axios';
import scheduleCard from '../components/scheduleCard.vue'
import { createToaster } from "@meforma/vue-toaster";

export default defineComponent({
    name: "schedule",
    components: {
        scheduleCard,
    },
    setup() {
        const schedules = ref([]);
        const schedule = ref([])
        const modalOpen = ref(false);
        const ScheduleId = ref();
        const erroInput = ref();

        const toaster = createToaster({ /* options */ });

        const openModal = () => {
            modalOpen.value = true;
        };

        const closeModal = () => {
            modalOpen.value = false;
            ScheduleId.value = null;
        };

        const fetchSchedules = () =>
            axiosApi.get("/schedule").then(res => {
                schedules.value = res.data;
            });

        const editSchedule = (scheduleId) => {
            axiosApi.get("/schedule/get/" + scheduleId).then(res => {
                schedule.value = res.data;
                ScheduleId.value = scheduleId;
                modalOpen.value = true;
            });
        };

        const SaveSchedule = (scheduleData) => {
            if (scheduleData.id) {
                axiosApi.post("/schedule/update/" + scheduleData.id, scheduleData)
                    .then(response => {
                        toaster.success('contato atualizado com sucesso!');
                        setTimeout(() => {
                            toaster.clear();
                            window.location.reload();
                        }, 2000);
                    }).catch(error => {
                        if (error.response.status === 422) {
                            const errors = error.response.data.errors;
                            Object.keys(errors).forEach(key => {
                                const errorMessages = errors[key];
                                errorMessages.forEach(message => {
                                    toaster.error(message);
                                });
                            });
                        } else {
                            toaster.error(`ocorreu um erro ao atualizar o contato`);
                        }
                    });
            } else {
                axiosApi.post("/schedule/create", scheduleData, {})
                    .then(response => {
                        toaster.success('Contato cadastrado com sucesso!');

                        setTimeout(() => {
                            toaster.clear();
                            window.location.reload();
                        }, 2000);
                    }).catch(error => {
                        if (error.response.status === 422) {
                            const errors = error.response.data.errors;
                            Object.keys(errors).forEach(key => {
                                const errorMessages = errors[key];
                                errorMessages.forEach(message => {
                                    toaster.error(message);
                                });
                            });
                        } else {
                            toaster.error('Ops! Ocorreu um erro ao cadastrar o contato');
                        }
                    });
            }
        }

        const removeSchedule = (scheduleId) => {
            axiosApi.delete("/schedule/delete/" + scheduleId)
                .then(response => {
                    toaster.success(`contato removido com sucesso !`);
                    setTimeout(() => {
                        toaster.clear();
                        window.location.reload();
                    }, 2000);
                })
                .catch(error => {
                    toaster.error(error.response.data.message);
                });
        };

        onMounted(fetchSchedules);

        return {
            schedules,
            schedule,
            ScheduleId,
            editSchedule,
            SaveSchedule,
            removeSchedule,
            openModal,
            modalOpen,
            closeModal,
            erroInput,
        };
    },
});
</script>
