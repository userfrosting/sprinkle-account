// TODO : These interfaces/types should be moved to a common UF package, like core.

export interface AlertInterface {
    title?: string
    description?: string
    style?: AlertStyle | keyof typeof AlertStyle
    closeBtn?: boolean
    hideIcon?: boolean
}

export enum AlertStyle {
    Primary = 'Primary',
    Success = 'Success',
    Warning = 'Warning',
    Danger = 'Danger'
}
