import { createWebHistory, createRouter } from 'vue-router'

const Start = () => import('@/components/Start')
const QuizSettings = () => import('@/components/QuizSettings')
const Question = () => import('@/components/Question')
const Result = () => import('@/components/Result')

const routes = [
    {
        name: "Start",
        path: "/",
        component: Start,
        meta: {
            title: `Start Quiz`
        }
    },
    {
        name: "Mode",
        path: "/mode",
        component: QuizSettings,
        meta: {
            title: `Quiz Mode`
        }
    },
    {
        name: "Quiz",
        path: "/quiz",
        component: Question,
        meta: {
            title: `Quiz`
        }
    },
    {
        name: "Result",
        path: "/result",
        component: Result,
        meta: {
            title: `Your score`
        }
    }

]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

//todo auth?

export default router
