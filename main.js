import { createApp, h } from 'vue'

const Vuenized = (options) => {
    let id = (typeof options.rootId === 'undefined') ? '#app' : `#${options.rootId}`

    const pageData = JSON.parse(document.querySelector(id).getAttribute('data-page'))
    const moduleName = `/${import.meta.env.VITE_RESOURCES_DIR}/views/${pageData.view}.vue`

    // uncomment this if using chunked
    // const allPages = import.meta.glob('@/views/**/*.vue', { eager: false})
    // const page = allPages[moduleName]()

    // uncomment this if using single file
    const allPages = import.meta.glob('@/views/**/*.vue', { eager: true})
    const page = allPages[moduleName]

    if (typeof page.then === 'function') {

        page.then((app) => {
            options.setup(app.default, Object.assign({}, pageData.data), id)
        })

    } else {
        
        options.setup(page.default, Object.assign({}, pageData.data), id)
    }

}

// create new Vue on CodeIgniter 4
Vuenized({
    rootId: import.meta.env.VITE_APP_ID,
    setup: (App, props, root) => {
        const app = createApp({
            render: () => h(App, props)
        })
        
        app.config.unwrapInjectedRef = true
        app.mount(root)
    }
})
