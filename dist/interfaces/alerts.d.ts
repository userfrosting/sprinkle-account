export interface AlertInterface {
    title?: string;
    description?: string;
    style?: AlertStyle | keyof typeof AlertStyle;
    closeBtn?: boolean;
    hideIcon?: boolean;
}
export declare enum AlertStyle {
    Primary = "Primary",
    Success = "Success",
    Warning = "Warning",
    Danger = "Danger"
}
