import { ReactNode } from "react";
import { Text } from "@kanban/ui/Text";
import * as S from "./DatePicker.styled";

type Props = {
    icon?: ReactNode;
    value: Date;
    label: string;
};

export function DateView(props: Props) {
    return (
        <div>
            <Text indent={1} type="body-5">
                {props.label}
            </Text>
            <S.Field style={{ cursor: "auto", userSelect: "all", width: 184 }}>
                {props.icon}
                <Text type="description-6">{props.value.toLocaleDateString("ru")}</Text>
            </S.Field>
        </div>
    );
}
