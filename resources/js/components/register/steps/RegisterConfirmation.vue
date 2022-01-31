<template lang="">
    <div class="step-widget">
        <h4 class="w-100 float-left text-center mb-4">Informações Iniciais</h4>
        
        <button class="nextStep" @click="register">
            Registrar
        </button>
    </div>
</template>
<script>
export default {
    name: "RegisterConfirmation",

    data() {
        return {
            data: {
                recaptcha: '',
                rewardType: ''
            }
        }
    },

    methods: {
        register() {
            this.$emit('register', this.data)
        }
    }
}
</script>