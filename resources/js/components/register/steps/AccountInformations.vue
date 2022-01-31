<template>
    <div class="step-widget">
        <h4 class="w-100 float-left text-center mb-4">Informações da Conta</h4>
        <div class="input-group mb-3">
            <span class="input-group-text" id="input-email">
                <i class="icon-email"></i>
            </span>
            <input type="email" class="form-control" placeholder="Digite seu e-mail" v-model="data.email" autocomplete="email" aria-label="Email" aria-describedby="input-email" autofocus>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="input-pass">
                <i class="icon-pass"></i>
            </span>
            <input type="password" class="form-control" placeholder="Digite sua senha" v-model="data.password" autocomplete="off" aria-label="Senha" aria-describedby="input-pass">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="input-pass-confirm">
                <i class="icon-pass"></i>
            </span>
            <input type="password" class="form-control" placeholder="Confirme sua senha" v-model="data.password_confirmation" autocomplete="off" aria-label="Confirmação de Senha" aria-describedby="input-pass-confirm">
        </div>
        <button class="nextStep" @click="nextStep">
            Continuar
        </button>
    </div>
</template>
<script>
export default {
    name: "AccountInformations",

    data() {
        return {
            data: {
                email: '',
                password: '',
                password_confirmation: ''
            }
        }
    },

    methods: {
        nextStep() {
            this.$emit('nextStep', this.data)
        }
    }
}
</script>