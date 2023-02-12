<template>
  <div class="auth-modal__content">
    <UiOverlay class="auth-modal__overlay" :is-loading="isLoading" />

    <h2 class="auth-modal__title">
      Восстановить<br>пароль
    </h2>

    <form class="auth-modal__form" novalidate @submit="submitForm">
      <UiInput
        v-model="email"
        class="auth-modal__form-input"
        placeholder="Ваш e-mail"
        type="email"
        name="email"
        :error-message="errors.email"
      />

      <UiButton class="auth-modal__submit" :disabled="buttonIsDisabled">
        Восстановить
      </UiButton>
    </form>

    <div class="auth-modal__bottom">
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
import { EMAIL_ERROR, REQUIRED_ERROR } from '~/utils/data/validateErrors'

defineEmits<{(e: 'changeMode', value: 'register'): void }>()

const isLoading = ref(false)
const validationSchema = toFormValidator(
  z.object({
    email: z.string().trim().nonempty(REQUIRED_ERROR).email({ message: EMAIL_ERROR })
  })
)
const { handleSubmit, errors } = useForm({ validationSchema })
const { value: email } = useField<string>('email', 'isRequired', { validateOnValueUpdate: false })
const submitForm = handleSubmit(async(values) => {
  isLoading.value = true

  const data = await useFetch(() => '/api/v1/auth', { method: 'POST', body: { email: values.email, password: values.password } })
})

const buttonIsDisabled = computed(() => !email.value)
</script>
