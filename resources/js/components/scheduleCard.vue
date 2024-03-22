<template>
    <div>
        <div v-if="modalOpen" class="modal">
            <div class="container col-md-6 col-12" role="dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ editingScheduleId ? 'Editar Contato' : 'Cadastro de Contato' }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" @click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome do contato <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nome" placeholder="Digite o nome do contato"
                                    v-model="contactName" required>
                                <p class="text-danger">{{ erroInput ? erroInput['nome'][0] : '' }}</p>
                            </div>
                            <div class="mb-3">
                                <label for="endereco" class="form-label">Endereço</label>
                                <input type="text" v-model="contactAndress" class="form-control" id="endereco"
                                    placeholder="Digite o endereço do contato">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                                <input name="email" class="form-control" id="email" placeholder="Digite o Email"
                                    v-model="contactEmail">
                                <p class="text-danger">{{ erroInput ? erroInput['email'][0] : '' }}</p>
                            </div>
                            <div class="mb-3">
                                <label for="telefone" class="form-label">telefone <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="telefone" placeholder="Digite o telefone"
                                    v-model="contactTelephone" @input="formatarTelefone">
                                <p class="text-danger">{{ erroInput ? erroInput['telefone'][0] : '' }}</p>
                            </div>
                            <button type="button" class="btn btn-primary" @click="SaveSchedule">{{ editingScheduleId ?
            'Salvar' : 'Cadastrar' }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    props: {
        modalOpen: Boolean, // Defina modalOpen como uma prop
        editingScheduleId: Number,
        scheduleData: {
            type: Object
        },
        erroInput: {
            type: Object,
        }
    },
    data() {
        return {
            contactName: '',
            contactEmail: '',
            contactAndress: '',
            contactTelephone: ''
        };
    },
    computed: {
        // Computed properties para associar o v-model aos valores corretos
        computedContactName: {
            get() {
                return this.scheduleData ? this.scheduleData.data.name : this.contactName;
            },
            set(value) {
                this.contactName = value;
            }
        },
        computedContactEmail: {
            get() {
                return this.scheduleData ? this.scheduleData.data.email : this.contactEmail;
            },
            set(value) {
                this.contactEmail = value;
            }
        },
        computedContactAndress: {
            get() {
                return this.scheduleData ? this.scheduleData.data.andress : this.contactAndress;
            },
            set(value) {
                this.contactAndress = value;
            }
        },
        computedContactTelephone: {
            get() {
                return this.scheduleData ? this.scheduleData.data.telephone : this.contactTelephone;
            },
            set(value) {
                this.contactTelephone = value;
            }
        }
    },
    watch: {
        editingScheduleId(ScheduleId) {
            if (ScheduleId) {
                // Atualize as computed properties com base na prop scheduleData
                this.computedContactName = this.scheduleData.data.name;
                this.computedContactAndress = this.scheduleData.data.andress;
                this.computedContactEmail = this.scheduleData.data.email;
                this.computedContactTelephone = this.scheduleData.data.telephone;
            }
        }
    },
    methods: {
        formatarTelefone() {
            let telefone = this.contactTelephone.replace(/\D/g, '');

            if (telefone.length === 11) {
                this.contactTelephone = '(' + telefone.substr(0, 2) + ') ' + telefone.substr(2, 5) + '-' + telefone.substr(7);
            } else if (telefone.length === 10) {
                this.contactTelephone = '(' + telefone.substr(0, 2) + ') ' + telefone.substr(2, 4) + '-' + telefone.substr(6);
            } else {
                this.contactTelephone = this.contactTelephone;
            }
        },
        closeModal() {
            this.$emit('close-modal');
            this.clearFields();
        },

        SaveSchedule() {
            const scheduleData = {
                name: this.contactName,
                andress: this.contactAndress,
                email: this.contactEmail,
                telephone: this.contactTelephone
            };

            if (this.editingScheduleId) {
                scheduleData.id = this.editingScheduleId;
            }
            this.$emit('save-schedule', scheduleData);
        },
        clearFields() {
            this.contactName = '';
            this.contactAndress = '';
            this.contactEmail = '';
            this.contactTelephone = '';

            this.erroInput.name = [];
            this.erroInput.contactAndress = [];
            this.erroInput.contactEmail = [];
            this.erroInput.contactTelephone = [];
        },
    },
};
</script>

<style scoped>
/* Estilos para o modal */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: white;
    padding: 20px;
    border: 1px solid #ccc;
    position: relative;
}

.close {
    position: absolute;
    top: 0;
    right: 0;
    padding: 10px;
    cursor: pointer;
}

.text-danger {
    font-size: 14px;
}
</style>
