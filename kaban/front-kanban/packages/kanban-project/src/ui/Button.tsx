import { CSSProperties, PropsWithChildren } from "react";
import styled, { css } from "styled-components";
import { Text } from "./Text";

type Variant = "primary" | "secondary" | "danger";

type Props = {
    variant: Variant;
    onClick: () => void;
    style?: CSSProperties;
};

const StyledButton = styled.button<{ variant: Variant }>`
    font-family: inherit;
    padding: 0 16px;
    cursor: pointer;
    border-radius: 5px;
    border: 0;

    color: var(--basic-white);
    ${({ variant }) => {
        switch (variant) {
            case "primary":
                return css`
                    background-color: #004ce3;
                `;
            case "secondary":
                return css`
                    background-color: var(--basic-grey);
                `;
            case "danger":
                return css`
                    background-color: var(--support-red);
                `;
        }
    }}
`;

export function Button(props: PropsWithChildren<Props>): JSX.Element {
    return (
        <StyledButton variant={props.variant} onClick={props.onClick} style={props.style}>
            <Text type="body-6">{props.children}</Text>
        </StyledButton>
    );
}
