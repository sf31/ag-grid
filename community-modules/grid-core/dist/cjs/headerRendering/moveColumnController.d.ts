// Type definitions for @ag-grid-community/core v22.0.0
// Project: http://www.ag-grid.com/
// Definitions by: Niall Crosby <https://github.com/ag-grid/>
import { Column } from "../entities/column";
import { DraggingEvent } from "../dragAndDrop/dragAndDropService";
import { GridPanel } from "../gridPanel/gridPanel";
import { DropListener } from "./bodyDropTarget";
import { ColumnEventType } from "../events";
export declare class MoveColumnController implements DropListener {
    private loggerFactory;
    private columnController;
    private dragAndDropService;
    private gridOptionsWrapper;
    private gridPanel;
    private needToMoveLeft;
    private needToMoveRight;
    private movingIntervalId;
    private intervalCount;
    private logger;
    private pinned;
    private centerContainer;
    private lastDraggingEvent;
    private failedMoveAttempts;
    private eContainer;
    constructor(pinned: string, eContainer: HTMLElement);
    registerGridComp(gridPanel: GridPanel): void;
    init(): void;
    getIconName(): string;
    onDragEnter(draggingEvent: DraggingEvent): void;
    onDragLeave(draggingEvent: DraggingEvent): void;
    setColumnsVisible(columns: Column[], visible: boolean, source?: ColumnEventType): void;
    setColumnsPinned(columns: Column[], pinned: string, source?: ColumnEventType): void;
    onDragStop(): void;
    private normaliseX;
    private checkCenterForScrolling;
    onDragging(draggingEvent: DraggingEvent, fromEnter?: boolean): void;
    private normaliseDirection;
    private calculateOldIndex;
    private attemptMoveColumns;
    private calculateValidMoves;
    private isColumnHidden;
    private ensureIntervalStarted;
    private ensureIntervalCleared;
    private moveInterval;
}
