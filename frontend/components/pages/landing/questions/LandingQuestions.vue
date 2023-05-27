<template>
    <section class="section">
        <div class="container">
            <div :class="$style.wrapper">
                <h2 :class="$style.title">
                    Вопросы и ответы
                </h2>

                <ul :class="$style.questionList">
                    <LandingQuestionsItem
                        v-for="item in questions"
                        :key="item.question"
                        v-bind="item"
                        :class="$style.questionItem"
                    />
                </ul>
            </div>
        </div>
    </section>
</template>

<script lang="ts" setup>
import LandingQuestionsItem from '~/components/pages/landing/questions/LandingQuestionsItem.vue'

const questions = ref([
    {
        question: 'Чему здесь можно научиться?',
        answer: 'Вы можете познакомиться с основами языков JavaScript, PHP, Java, Python и других'
    },
    {
        question: 'Как проходит обучение?',
        answer: 'Курсы программирования состоят из тематических блоков, в каждом есть несколько уроков. Проходите уроки последовательно: сначала изучите теорию, потом выполните практическое упражнение прямо в браузере – система проверит его автоматически.'
    },
    {
        question: 'Как начать обучение?',
        answer: 'Достаточно просто зарегистрироваться. Регистрация на платформе бесплатная, после регистрации вы получите доступ ко всем курсам.'
    }
])
</script>

<style lang="sass" module>
.wrapper
    display: flex
    flex-direction: column
    align-items: center
    max-width: 700px
    margin: 0 auto

.title
    @include h1
    margin-bottom: $offset-m
    color: $blue-main

.questionList
    width: 100%

.questionItem
    &:not(:last-child)
        margin-bottom: $offset-m
</style>
