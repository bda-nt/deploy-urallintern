import { CSSProperties } from "react";
import { SvgWrapper } from "./SvgWrapper";

type Props = {
    style?: CSSProperties;
    onClick?: () => void;
};

export function PlusInsideBoxIcon(props: Props) {
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
                d="M14.6667 3.33325V12.6666C14.6667 13.7712 13.7713 14.6666 12.6667 14.6666H3.33337C2.2288 14.6666 1.33337 13.7712 1.33337 12.6666V3.33325C1.33337 2.22868 2.2288 1.33325 3.33337 1.33325H12.6667C13.7713 1.33325 14.6667 2.22868 14.6667 3.33325ZM12 7.99992C12 8.36811 11.7016 8.66658 11.3334 8.66658H8.66671V11.3333C8.66671 11.7014 8.36823 11.9999 8.00004 11.9999C7.63185 11.9999 7.33337 11.7014 7.33337 11.3333V8.66658H4.66671C4.29852 8.66658 4.00004 8.36811 4.00004 7.99992C4.00004 7.63173 4.29852 7.33325 4.66671 7.33325H7.33337V4.66659C7.33337 4.2984 7.63185 3.99992 8.00004 3.99992C8.36823 3.99992 8.66671 4.2984 8.66671 4.66659V7.33325H11.3334C11.7016 7.33325 12 7.63173 12 7.99992ZM12.6667 2.66659C13.0349 2.66659 13.3334 2.96506 13.3334 3.33325V12.6666C13.3334 13.0348 13.0349 13.3333 12.6667 13.3333H3.33337C2.96518 13.3333 2.66671 13.0348 2.66671 12.6666V3.33325C2.66671 2.96506 2.96518 2.66659 3.33337 2.66659H12.6667Z"
                fill="#231F20"
            />
        </SvgWrapper>
    );
}
