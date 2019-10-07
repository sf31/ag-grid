import {Module} from "../interfaces/iModule";
import {ModuleNames} from "./moduleNames";
import {Grid} from "../grid";
import {ClientSideRowModel} from "./clientSideRowModel/clientSideRowModel";

export const ClientSideRowModelModule: Module = {
    moduleName: ModuleNames.ClientSideRowModelModule,
    beans: []
};

Grid.addModule([ClientSideRowModelModule]);
Grid.addRowModelClass('clientSide', ClientSideRowModel);
