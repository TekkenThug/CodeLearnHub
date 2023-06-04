<template>
    <div class="auth-modal__content">
        <UiOverlay class="auth-modal__overlay" :is-loading="isLoading" />

        <h2 class="auth-modal__title">
            Регистрация
        </h2>

        <form class="auth-modal__form" novalidate @submit="submitForm">
            <UiInput
                v-model="nickname"
                class="auth-modal__form-input"
                placeholder="Никнейм"
                name="nickname"
                :error-message="errors.nickname"
            />

            <UiInput
                v-model="email"
                class="auth-modal__form-input"
                placeholder="E-mail"
                type="email"
                name="email"
                :error-message="errors.email"
            />

            <UiInput
                v-model="password"
                class="auth-modal__form-input"
                placeholder="Пароль"
                type="password"
                name="password"
                :error-message="errors.password"
            />

            <UiButton class="auth-modal__submit" :disabled="buttonIsDisabled">
                Регистрация
            </UiButton>
        </form>

        <div class="auth-modal__bottom" @click="$emit('changeMode', 'login')">
            <UiButtonLight class="auth-modal__button">
                Уже есть аккаунт?
            </UiButtonLight>
        </div>
    </div>
</template>

<script setup lang="ts">
import { useField, useForm } from 'vee-validate'
import { toFormValidator } from '@vee-validate/zod'
import { z } from 'zod'
import { PASSWORD_REGEXP } from '~/utils/data/regexp'
import {
    REQUIRED_ERROR,
    EMAIL_ERROR,
    PASSSWORD_ERROR
} from '~/utils/data/validateErrors'

const emit = defineEmits<{(e: 'changeMode', value: 'login'): void }>()

const http = useHttp()
const notify = useToast()
const isLoading = ref(false)
const validationSchema = toFormValidator(
    z.object({
        nickname: z.string().trim().nonempty(REQUIRED_ERROR),
        email: z.string().trim().nonempty(REQUIRED_ERROR).email({ message: EMAIL_ERROR }),
        password: z.string().trim().nonempty(REQUIRED_ERROR).regex(PASSWORD_REGEXP, PASSSWORD_ERROR)
    })
)
const { handleSubmit, errors } = useForm({ validationSchema })
const { value: nickname } = useField<string>('nickname', 'isRequired', { validateOnValueUpdate: false })
const { value: email } = useField<string>('email', 'isRequired', { validateOnValueUpdate: false })
const { value: password } = useField<string>('password', 'isRequired', { validateOnValueUpdate: false })
const buttonIsDisabled = computed(() => !nickname.value || !email.value || !password.value)
const submitForm = handleSubmit((values) => {
    isLoading.value = true

    http.post('/api/v1/auth/register', {
        nickname: values.nickname,
        email: values.email,
        password: values.password
    })
        .then(() => {
            notify.success('Регистрация прошла успешно!')
            emit('changeMode', 'login')
        })
        .catch((e) => {
            if (e?.response?.data) {
                notify.error(e.response.data.error || e.response.data.message)
            }
        })
        .finally(() => {
            isLoading.value = false
        })
})
</script>
