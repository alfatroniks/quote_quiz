import { createWebHistory, createRouter } from 'vue-router'
import {useAuthStore} from "@/stores/auth";

const Start = () => import('@/pages/Start.vue')
const QuizSettings = () => import('@/pages/QuizSettings.vue')
const Question = () => import('@/pages/Question.vue')
const Result = () => import('@/pages/Result.vue')
const Scores = () => import('@/pages/Scores.vue')
const Login = () => import('@/pages/admin/Login')
const QuestionsList = () => import('@/pages/admin/QuestionsList')
const QuestionForm = () => import('@/pages/admin/QuestionForm')
const AdminSettings = () => import('@/pages/admin/AdminSettings.vue')

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
    },
    {
        name: "Scores",
        path: "/scores",
        component: Scores,
        meta: {
            title: `Scores`
        }
    },
    {
        name: "Login",
        path: "/login",
        component: Login,
        meta: {
            title: `Login`
        }
    },
    {
        path: "/admin",
        meta: {
            auth: true,
            isAmin: true
        },
        children: [
            {
                name: "Settings",
                path: '',
                component: AdminSettings,
                meta: {
                    title: `Settings`
                }
            },
            {
                name: "QuestionsList",
                path: 'questions',
                component: QuestionsList,
                meta: {
                    title: `List of Questions`
                }
            },
            {
                name: "EditQuestion",
                path: 'question/:questionId?',
                component: QuestionForm,
                props: true,
                meta: {
                    title: `Edit Questions`
                }
            },
            {
                name: "AdminScores",
                path: 'scores',
                component: Scores,
                meta: {
                    title: `Scores`
                }
            },
        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach(async (to, from, next) => {
    const authStore = useAuthStore();
    // await authStore.checkUser();

    if (to.meta.auth && !authStore.user) {
        next('/login');
    } else if (to.meta.isAdmin && !authStore.user?.is_admin) {
        next('/');
    } else {
        next();
    }
});

export default router
