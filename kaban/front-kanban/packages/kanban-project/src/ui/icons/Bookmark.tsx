import { CSSProperties } from "react";
import { SvgWrapper } from "./SvgWrapper";

type Props = {
    style?: CSSProperties;
    onClick?: () => void;
};

export function BookmarkIcon(props: Props) {
    return (
        <SvgWrapper
            viewBox={16}
            style={props.style}
            onClick={(e) => {
                e.stopPropagation();
                if (props.onClick) props.onClick();
            }}
        >
            <path
                fillRule="evenodd"
                clipRule="evenodd"
                d="M4.66667 1.37329H11.3333C12.4611 1.39879 13.3557 2.33208 13.3333 3.45996V13.2466C13.3361 13.7905 13.0207 14.2858 12.5267 14.5133C12.3583 14.5865 12.1769 14.6251 11.9933 14.6266C11.6691 14.6246 11.3574 14.5009 11.12 14.28L8 11.44L4.88 14.28C4.49558 14.623 3.94792 14.7138 3.47334 14.5133C2.9793 14.2858 2.66388 13.7905 2.66667 13.2466V3.45996C2.64433 2.33208 3.53886 1.39879 4.66667 1.37329ZM8.88667 10.4533L12 13.2933V3.45996C12.0191 3.0695 11.7232 2.73511 11.3333 2.70662H4.66667C4.27679 2.73511 3.98086 3.0695 4 3.45996V13.2466L7.08667 10.4533C7.59615 9.98719 8.37719 9.98719 8.88667 10.4533Z"
                fill="#231F20"
            />
        </SvgWrapper>
    );
}
