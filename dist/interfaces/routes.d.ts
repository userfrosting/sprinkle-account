
export interface RouteGuard {
    redirect: string | {
        name: string;
    };
}
declare module 'vue-router' {
    interface RouteMeta {
        auth?: RouteGuard;
        guest?: RouteGuard;
    }
}
