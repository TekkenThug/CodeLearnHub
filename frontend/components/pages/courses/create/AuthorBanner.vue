<template>
    <div>
        <div class="container">
            <div :class="$style.wrapper">
                <h1 :class="[$style.title, 'page-title']">
                    Станьте автором курсов<br>по программированию
                </h1>

                <div :class="$style.text">
                    <p>
                        Превратите свои знания и опыт в уникальные онлайн-курсы!
                        Станьте автором курсов по программированию и делитесь своими знаниями с миром.
                        Раскройте свой потенциал и станьте источником вдохновения для начинающих и опытных программистов.
                    </p>

                    <p>
                        Наша платформа предоставляет все инструменты, необходимые для создания курсов.
                        Выбирайте свой язык, структурируйте материалы и добавляйте.
                        Вместе мы можем изменить мир программирования и помочь другим достичь успеха в этой захватывающей области!
                    </p>

                    <p>
                        Мы ищем авторов, которые обладают глубоким практическим опытом в программировании.
                        Будьте готовы доказать свои знания и достижения в выбранной области.
                    </p>

                    <p>
                        Для получения подробной информации, пожалуйста, оставьте свою почту и мы свяжемся с Вами!
                    </p>
                </div>

                <transition name="fade" mode="out-in">
                    <div v-if="done" :class="$style.done">
                        Заявка отправлена!
                    </div>

                    <form
                        v-else
                        :class="$style.form"
                        novalidate
                        @submit="submitForm"
                    >
                        <UiInput
                            v-model="email"
                            :error-message="errors.email"
                            name="email"
                            type="email"
                            placeholder="E-mail"
                            :class="$style.field"
                        />

                        <UiButton
                            :disabled="buttonIsDisabled"
                            :class="$style.button"
                        >
                            Стать автором
                        </UiButton>
                    </form>
                </transition>

                <img
                    :class="$style.image"
                    src="~/assets/images/courses/create.png"
                    alt="Laptop"
                >
            </div>
        </div>
    </div>
</template>

<script setup>
import { useField, useForm } from 'vee-validate'
import { toFormValidator } from '@vee-validate/zod'
import { z } from 'zod'
import { EMAIL_ERROR, REQUIRED_ERROR } from '~/utils/data/validateErrors'
import { useUserStore } from '~/stores/user'

const http = useHttp()
const notify = useToast()
const userStore = useUserStore()
const done = ref(false)
const buttonIsDisabled = computed(() => !email.value)
const validationSchema = toFormValidator(
    z.object({
        email: z.string().trim().nonempty(REQUIRED_ERROR).email({ message: EMAIL_ERROR })
    })
)
const { handleSubmit, errors } = useForm({ validationSchema, initialValues: { email: userStore?.user?.email } })
const { value: email } = useField('email', 'isRequired', {
    validateOnValueUpdate: false
})
const submitForm = handleSubmit(async() => {
    try {
        await http.post('/api/v1/tickets', {
            theme: 'Запрос на авторство',
            email: email.value,
            text: 'Хочу стать автором!'
        })
        done.value = true
    } catch (e) {
        if (e.response?.data?.error) {
            notify.error(e.response.data.error)
        }
    }
})
</script>

<style lang="sass" module>
.title
    text-align: center

.wrapper
    max-width: 780px
    margin: 0 auto

.form
    display: flex
    align-items: flex-start

    @include responsive($mobile)
        flex-direction: column

.text
    font-size: 18px
    line-height: 32px

    p
        margin: $offset-xs 0

.field
    flex-grow: 1
    margin-right: $offset-xs

    @include responsive($mobile)
        margin-right: 0
        margin-bottom: $offset-xs
        width: 100%

.done
    @include h2
    color: $blue-main
    text-align: center

.button
    @include responsive($mobile)
        width: 100%

.image
    display: block
    height: 340px
    margin: $offset-m auto 0

    @include responsive($mobile)
        height: auto
        width: 100%
</style>
