<template>
    <main class="page">
        <div class="container">
            <h1 class="page-title">
                Контакты
            </h1>

            <ul :class="$style.contacts">
                <li>
                    <strong>E-mail:</strong> <span>ignatov0131@gmail.com</span>
                </li>
            </ul>

            <form novalidate @submit="submitForm">
                <div :class="$style.question">
                    <h3 :class="$style.subtitle">
                        Остались вопросы?
                    </h3>
                    <p>Оставьте свое обращение, и мы свяжемся с Вами в ближайшее время</p>
                </div>

                <div :class="$style.content">
                    <div :class="$style.row">
                        <UiInput
                            v-model="email"
                            :class="$style.field"
                            placeholder="E-mail"
                            type="email"
                            :error-message="errors.email"
                            name="email"
                        />

                        <UiInput
                            v-model="theme"
                            :class="$style.field"
                            placeholder="Тема"
                            :error-message="errors.theme"
                            name="theme"
                        />
                    </div>

                    <UiTextarea
                        v-model="text"
                        :error-message="errors.text"
                        :class="$style.textarea"
                        :max-length="1000"
                        placeholder="Сообщение"
                        name="text"
                    />

                    <UiButton :disabled="buttonIsDisabled">
                        Отправить обращение
                    </UiButton>

                    <UiOverlay
                        :is-loading="isLoading"
                        :class="$style.overlay"
                    />
                </div>
            </form>
        </div>
    </main>
</template>

<script lang="ts" setup>
import { useField, useForm } from 'vee-validate'
import { toFormValidator } from '@vee-validate/zod'
import { z } from 'zod'
import { EMAIL_ERROR, REQUIRED_ERROR } from '~/utils/data/validateErrors'
import UiTextarea from '~/components/ui/UiTextarea.vue'

const validationSchema = toFormValidator(
    z.object({
        email: z.string().trim().nonempty(REQUIRED_ERROR).email({ message: EMAIL_ERROR }),
        theme: z.string().trim().nonempty(REQUIRED_ERROR),
        text: z.string().trim().nonempty(REQUIRED_ERROR)
    })
)
const { handleSubmit, errors } = useForm({ validationSchema })
const { value: email } = useField<string>('email', 'isRequired', { validateOnValueUpdate: false })
const { value: theme } = useField<string>('theme', 'isRequired', { validateOnValueUpdate: false })
const { value: text } = useField<string>('text', 'isRequired', { validateOnValueUpdate: false })
const buttonIsDisabled = computed(() => {
    return !email.value || !theme.value || !text.value
})
const isLoading = ref(false)
const http = useHttp()
const notify = useToast()

const submitForm = handleSubmit(async() => {
    isLoading.value = true

    try {
        const { data: { message } } = await http.post('/api/v1/tickets', {
            email: email.value,
            text: text.value,
            theme: theme.value
        })
        notify.success(message)
        email.value = theme.value = text.value = ''
    } catch (e) {
        if (e.response?.data?.error) {
            notify.error(e.response.data.error)
        }
    } finally {
        isLoading.value = false
    }
})
</script>

<style lang="sass" module>
.contacts
    margin-bottom: $offset-xl

.subtitle
    @include h2
    color: $blue-main
    margin-bottom: $offset-xxs

.question
    margin-bottom: $offset-l

.row
    display: flex
    justify-content: space-between

    @include responsive($mobile)
        flex-direction: column

.field
    width: 49%

    @include responsive($mobile)
        width: 100%

        &:not(:last-child)
            margin-bottom: $offset-m

.content
    display: flex
    flex-direction: column
    position: relative

.textarea
    margin: $offset-m 0

.overlay
    width: 100%
    height: 100%
</style>
