<template>
    <div class="register-page">
        <div class="register-header"></div>
        <div class="container">
            <div class="register-step">
                <button
                    :class="{ 'active': isFirstStep(), 'completed': firstStepCompleted() }"
                >
                    <i :class="['mt-1 mr-2', { 'comments': isFirstStep(), 'delete': !isFirstStep() && !firstStepCompleted() }, { 'save': firstStepCompleted() }]"></i>
                    Informações Iniciais
                </button>
                <div :class="['buttons', { 'left right': i == 1 }, { 'right': i == 2 }, { 'completed': firstStepCompleted() }]" v-for="i in 2" :key="i+1"></div>
                <button
                    :class="{ 'active': isSecondStep(), 'completed': secondStepCompleted() }"
                >
                    <i :class="['mt-1 mr-2', { 'comments': isSecondStep(), 'delete': !isSecondStep() && !secondStepCompleted() }, { 'save': secondStepCompleted() }]"></i>
                    Informações da Conta
                </button>
                <div :class="['buttons', { 'left right': i == 1 }, { 'right': i == 2 }, { 'completed': secondStepCompleted() }]" v-for="i in 2" :key="i+3"></div>
                <button
                    :class="{ 'active': isThirdStep(), 'completed': thirdStepCompleted() }"
                >
                    <i :class="['mt-1 mr-2', { 'comments': isThirdStep(), 'delete': !isThirdStep() && !thirdStepCompleted() }, { 'save': thirdStepCompleted() }]"></i>
                    Confirmação
                </button>
            </div>
            <div class="steps">
                <transition name="fade" mode="out-in">
                    <component @nextStep="resolveNextStep" v-bind:is="currentComponent" />
                </transition>
            </div>
        </div>
    </div>
</template>
<script>
import AccountInformations from './steps/AccountInformations'
import FirstAccountInformations from './steps/FirstAccountInformations'

export default {
    name: "RegisterPage",

    components: {
        FirstAccountInformations,
        AccountInformations
    },

    data() {
        return {
            currentComponent: 'first-account-informations',
            currentStep: 0,
            completedSteps: {
                1: false,
                2: false
            },
            data: {}
        }
    },

    methods: {
        validComponents() {
            return [
                'first-account-informations',
                'account-informations'
            ]
        },

        isFirstStep() {
            return this.isStep(0)
        },

        isSecondStep() {
            return this.isStep(1)
        },

        isThirdStep() {
            return this.isStep(2)
        },

        isStep(step) {
            return this.currentStep === step
        },

        firstStepCompleted() {
            return this.completedStep(0)
        },

        secondStepCompleted() {
            return this.completedStep(1)
        },

        thirdStepCompleted() {
            return this.completedStep(2)
        },

        completedStep(step) {
            return !! this.completedSteps[step]
        },

        randomKey() {
            return (Math.random() + 1).toString(36).substring(7);
        },

        resolveNextStep(data) {
            Object.keys(data).forEach(keyName => {
                this.$set(this.data, keyName, data[keyName])
            })

            console.log(this.data)
            this.nextStep();
        },

        nextStep() {
            let components = this.validComponents()

            this.completedSteps[this.currentStep] = true
            this.currentStep++
            this.currentComponent = components[this.currentStep]
        }
    }
}
</script>
<style>
.fade-enter-active, .fade-leave-active {
    transition: opacity .5s;
}
.fade-enter, .fade-leave-to {
    opacity: 0;
}
</style>