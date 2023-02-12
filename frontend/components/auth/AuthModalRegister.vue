<template>
  <div class="auth-modal__content">
    <UiOverlay class="auth-modal__overlay" :is-loading="isLoading" />

    <h2 class="auth-modal__title">
      Регистрация
    </h2>

    <form class="auth-modal__form" novalidate @submit="submitForm">
      <UiInput
        v-model="firstName"
        class="auth-modal__form-input"
        placeholder="Имя"
        name="first-name"
        :error-message="errors.firstName"
      />

      <UiInput
        v-model="secondName"
        class="auth-modal__form-input"
        placeholder="Фамилия"
        name="second-name"
        :error-message="errors.secondName"
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
        Войти
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

defineEmits<{(e: 'changeMode', value: 'login'): void }>()

const isLoading = ref(false)
const validationSchema = toFormValidator(
  z.object({
    firstName: z.string().trim().nonempty(REQUIRED_ERROR),
    secondName: z.string().trim().nonempty(REQUIRED_ERROR),
    email: z.string().trim().nonempty(REQUIRED_ERROR).email({ message: EMAIL_ERROR }),
    password: z.string().trim().nonempty(REQUIRED_ERROR).regex(PASSWORD_REGEXP, PASSSWORD_ERROR)
  })
)
const { handleSubmit, errors } = useForm({ validationSchema })
const { value: firstName } = useField<string>('firstName', 'isRequired', { validateOnValueUpdate: false })
const { value: secondName } = useField<string>('secondName', 'isRequired', { validateOnValueUpdate: false })
const { value: email } = useField<string>('email', 'isRequired', { validateOnValueUpdate: false })
const { value: password } = useField<string>('password', 'isRequired', { validateOnValueUpdate: false })
const submitForm = handleSubmit(async(values) => {
  isLoading.value = true

  const data = await useFetch(() => '/api/v1/auth', { method: 'POST', body: { email: values.email, password: values.password } })
})

const buttonIsDisabled = computed(() => !firstName.value || !secondName.value || !email.value || !password.value)
</script>
