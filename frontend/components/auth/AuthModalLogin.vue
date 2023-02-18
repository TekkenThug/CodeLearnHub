<template>
  <div class="auth-modal__content">
    <UiOverlay class="auth-modal__overlay" :is-loading="isLoading" />

    <h2 class="auth-modal__title">
      Вход в аккаунт
    </h2>

    <form class="auth-modal__form" novalidate @submit="submitForm">
      <UiInput
        v-model="email"
        class="auth-modal__form-input"
        placeholder="E-mail"
        type="email"
        :error-message="errors.email"
        name="email"
      />

      <UiInput
        v-model="password"
        class="auth-modal__form-input"
        placeholder="Пароль"
        type="password"
        :error-message="errors.password"
        name="password"
      />

      <UiButton class="auth-modal__submit" :disabled="buttonIsDisabled">
        Войти
      </UiButton>
    </form>

    <div class="auth-modal__bottom">
      <UiButtonLight class="auth-modal__button" @click="$emit('changeMode', 'forgot')">
        Забыли пароль?
      </UiButtonLight>

      <span>или</span>

      <UiButtonLight class="auth-modal__button" @click="$emit('changeMode', 'register')">
        Нет аккаунта?
      </UiButtonLight>
    </div>
  </div>
</template>

<script setup lang="ts">
import { useField, useForm } from 'vee-validate'
import { toFormValidator } from '@vee-validate/zod'
import { z } from 'zod'
import { REQUIRED_ERROR, EMAIL_ERROR } from '~/utils/data/validateErrors'

defineEmits<{(e: 'changeMode', value: 'register' | 'forgot'): void }>()

const validationSchema = toFormValidator(
  z.object({
    email: z.string().trim().nonempty(REQUIRED_ERROR).email({ message: EMAIL_ERROR }),
    password: z.string().trim().nonempty(REQUIRED_ERROR)
  })
)

const isLoading = ref(false)
const { handleSubmit, errors } = useForm({ validationSchema })
const { value: email } = useField<string>('email', 'isRequired', { validateOnValueUpdate: false })
const { value: password } = useField<string>('password', 'isRequired', { validateOnValueUpdate: false })
const submitForm = handleSubmit(async(values) => {
  isLoading.value = true

  const data = await useFetch(() => '/api/v1/auth', { method: 'POST', body: { email: values.email, password: values.password } })
})

const buttonIsDisabled = computed(() => !email.value || !password.value)
</script>