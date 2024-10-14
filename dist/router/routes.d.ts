declare const routes: {
    path: string;
    name: string;
    meta: {
        guest: {
            redirect: {
                name: string;
            };
        };
    };
    component: () => Promise<typeof import("../views/LoginView.vue")>;
}[];
export default routes;
