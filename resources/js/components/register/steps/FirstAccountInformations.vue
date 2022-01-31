<template>
    <div class="step-widget">
        <h4 class="w-100 float-left text-center mb-4">Informações Iniciais</h4>
        <div class="input-group mb-3">
            <span class="input-group-text" id="input-username">
                <i class="user-icon"></i>
            </span>
            <input type="text" class="form-control" @keyup.enter="nextStep" placeholder="Username" v-model="username" autofocus autocomplete="username" aria-label="Username" aria-describedby="input-username">
        </div>
        <button class="nextStep" @click="nextStep">
            Continuar
        </button>
    </div>
</template>
<script>
export default {
    name: "FirstAccountInformations",

    data() {
        return {
            username: ''
        }
    },

    methods: {
        nextStep() {
            this.$emit('nextStep', { username: this.username })
        }
    }
};
</script>
