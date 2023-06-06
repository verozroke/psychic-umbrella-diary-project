import {createRouter, createWebHashHistory} from 'vue-router'

const router = createRouter({
    history: createWebHashHistory(),
    routes: [
        {path: '/', name: 'Home', component: () => import('@pages/HomePage.vue')},
        {path: '/test', name: 'Test', component: () => import('@pages/TestPage.vue')},
    ]
})

// Test


export default router