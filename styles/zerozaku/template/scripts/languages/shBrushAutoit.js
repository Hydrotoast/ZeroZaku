
;(function()
{
	// CommonJS
	typeof(require) != 'undefined' ? SyntaxHighlighter = require('shCore').SyntaxHighlighter : null;

	function Brush()
	{
		var funcs = 'Abs ACos AdlibRegister AdlibUnRegister Asc AscW ASin Assign ATan AutoItSetOption AutoItWinGetTitle ' +
					'AutoItWinSetTitle Beep Binary BinaryLen BinaryMid BinaryToString BitAND BitNOT BitOR BitRotate BitShift ' +
					'BitXOR BlockInput Break Call CDTray Ceiling Chr ChrW ClipGet ClipPut ConsoleRead ConsoleWrite ConsoleWriteError ' +
					'ControlClick ControlCommand ControlDisable ControlEnable ControlFocus ControlGetFocus ControlGetHandle ' +
					'ControlGetPos ControlGetText ControlHide ControlListView ControlMove ControlSend ControlSetText ControlShow ' +
					'ControlTreeView Cos Dec DirCopy DirCreate DirGetSize DirMove DirRemove DllCall DllCallbackFree DllCallbackGetPtr ' +
					'DllCallbackRegister DllClose DllOpen DllStructCreate DllStructGetData DllStructGetPtr DllStructGetSize ' +
					'DllStructSetData DriveGetDrive DriveGetFileSystem DriveGetLabel DriveGetSerial DriveGetType DriveMapAdd ' +
					'DriveMapDel DriveMapGet DriveSetLabel DriveSpaceFree DriveSpaceTotal DriveStatus EnvGet EnvSet EnvUpdate Eval ' +
					'Execute Exp FileChangeDir FileClose FileCopy FileCreateNTFSLink FileCreateShortcut FileDelete FileExists ' + 
					'FileFindFirstFile FileFindNextFile FileFlush FileGetAttrib FileGetEncoding FileGetLongName FileGetPos ' +
					'FileGetShortcut FileGetShortName FileGetSize FileGetTime FileGetVersion FileInstall FileMove FileOpen ' +
					'FileOpenDialog FileRead FileReadLine FileRecycle FileRecycleEmpty FileSaveDialog FileSelectFolder FileSetAttrib ' +
					'FileSetPos FileSetTime FileWrite FileWriteLine Floor FtpSetProxy GUICreate GUICtrlCreateAvi GUICtrlCreateButton ' +
					'GUICtrlCreateCheckbox GUICtrlCreateCombo GUICtrlCreateContextMenu GUICtrlCreateDate GUICtrlCreateDummy ' +
					'GUICtrlCreateEdit GUICtrlCreateGraphic GUICtrlCreateGroup GUICtrlCreateIcon GUICtrlCreateInput GUICtrlCreateLabel ' +
					'GUICtrlCreateList GUICtrlCreateListView GUICtrlCreateListViewItem GUICtrlCreateMenu GUICtrlCreateMenuItem ' +
					'GUICtrlCreateMonthCal GUICtrlCreateObj GUICtrlCreatePic GUICtrlCreateProgress GUICtrlCreateRadio ' +
					'GUICtrlCreateSlider GUICtrlCreateTab GUICtrlCreateTabItem GUICtrlCreateTreeView GUICtrlCreateTreeViewItem ' +
					'GUICtrlCreateUpdown GUICtrlDelete GUICtrlGetHandle GUICtrlGetState GUICtrlRead GUICtrlRecvMsg ' +
					'GUICtrlRegisterListViewSort GUICtrlSendMsg GUICtrlSendToDummy GUICtrlSetBkColor GUICtrlSetColor GUICtrlSetCursor ' +
					'GUICtrlSetData GUICtrlSetDefBkColor GUICtrlSetDefColor GUICtrlSetFont GUICtrlSetGraphic GUICtrlSetImage ' +
					'GUICtrlSetLimit GUICtrlSetOnEvent GUICtrlSetPos GUICtrlSetResizing GUICtrlSetState GUICtrlSetStyle GUICtrlSetTip ' +
					'GUIDelete GUIGetCursorInfo GUIGetMsg GUIGetStyle GUIRegisterMsg GUISetAccelerators GUISetBkColor GUISetCoord ' +
					'GUISetCursor GUISetFont GUISetHelp GUISetIcon GUISetOnEvent GUISetState GUISetStyle GUIStartGroup GUISwitch Hex ' +
					'HotKeySet HttpSetProxy HttpSetUserAgent HWnd InetClose InetGet InetGetInfo InetGetSize InetRead IniDelete IniRead ' +
					'IniReadSection IniReadSectionNames IniRenameSection IniWrite IniWriteSection InputBox Int IsAdmin IsArray IsBinary ' +
					'IsBool IsDeclared IsDllStruct IsFloat IsHWnd IsInt IsKeyword IsNumber IsObj IsPtr IsString Log MemGetStats Mod ' +
					'MouseClick MouseClickDrag MouseDown MouseGetCursor MouseGetPos MouseMove MouseUp MouseWheel MsgBox Number ObjCreate ' +
					'ObjEvent ObjGet ObjName OnAutoItExitRegister OnAutoItExitUnRegister Ping PixelChecksum PixelGetColor PixelSearch ' +
					'PluginClose PluginOpen ProcessClose ProcessExists ProcessGetStats ProcessList ProcessSetPriority ProcessWait ' +
					'ProcessWaitClose ProgressOff ProgressOn ProgressSet Ptr Random RegDelete RegEnumKey RegEnumVal RegRead RegWrite ' +
					'Round Run RunAs RunAsWait RunWait Send SendKeepActive SetError SetExtended ShellExecute ShellExecuteWait Shutdown ' +
					'Sin Sleep SoundPlay SoundSetWaveVolume SplashImageOn SplashOff SplashTextOn Sqrt SRandom StatusbarGetText StderrRead ' +
					'StdinWrite StdioClose StdoutRead String StringAddCR StringCompare StringFormat StringFromASCIIArray StringInStr ' +
					'StringIsAlNum StringIsAlpha StringIsASCII StringIsDigit StringIsFloat StringIsInt StringIsLower StringIsSpace ' +
					'StringIsUpper StringIsXDigit StringLeft StringLen StringLower StringMid StringRegExp StringRegExpReplace ' +
					'StringReplace StringRight StringSplit StringStripCR StringStripWS StringToASCIIArray StringToBinary StringTrimLeft ' +
					'StringTrimRight StringUpper Tan TCPAccept TCPCloseSocket TCPConnect TCPListen TCPNameToIP TCPRecv TCPSend ' +
					'TCPShutdown, UDPShutdown TCPStartup, UDPStartup TimerDiff TimerInit ToolTip TrayCreateItem TrayCreateMenu ' +
					'TrayGetMsg TrayItemDelete TrayItemGetHandle TrayItemGetState TrayItemGetText TrayItemSetOnEvent TrayItemSetState ' +
					'TrayItemSetText TraySetClick TraySetIcon TraySetOnEvent TraySetPauseIcon TraySetState TraySetToolTip TrayTip UBound ' +
					'UDPBind UDPCloseSocket UDPOpen UDPRecv UDPSend VarGetType WinActivate WinActive WinClose WinExists WinFlash ' +
					'WinGetCaretPos WinGetClassList WinGetClientSize WinGetHandle WinGetPos WinGetProcess WinGetState WinGetText ' +
					'WinGetTitle WinKill WinList WinMenuSelectItem WinMinimizeAll WinMinimizeAllUndo WinMove WinSetOnTop WinSetState ' +
					'WinSetTitle WinSetTrans WinWait WinWaitActive WinWaitClose WinWaitNotActive';
		var macros = '@AppDataCommonDir @AppDataDir @AutoItExe @AutoItPID @AutoItVersion @AutoItX64 @COM_EventObj @CommonFilesDir ' +
				'@Compiled @ComputerName @ComSpec @CPUArch @CR @CRLF @DesktopCommonDir @DesktopDir @DesktopHeight @DesktopWidth ' +
				'@DesktopDepth @DesktopRefresh @DocumentsCommonDir @error @exitCode @exitMethod @extended @FavoritesCommonDir ' +
				'@FavoritesDir @GUI_CtrlId @GUI_CtrlHandle @GUI_DragId @GUI_DragFile @GUI_DropId @GUI_WinHandle @HomeDrive @HomePath ' +
				'@HomeShare @HOUR @HotKeyPressed @IPAddress1 @IPAddress2 @IPAddress3 @IPAddress4 @KBLayout @LF @LogonDNSDomain ' +
				'@LogonDomain @LogonServer @MDAY @MIN @MON @MSEC @MUILang @MyDocumentsDir @NumParams @OSArch @OSBuild @OSLang ' +
				'@OSServicePack @OSType @OSVersion @ProgramFilesDir @ProgramsCommonDir @ProgramsDir @ScriptDir @ScriptFullPath ' +
				'@ScriptLineNumber @ScriptName @SEC @StartMenuCommonDir @StartMenuDir @StartupCommonDir @StartupDir @SW_DISABLE ' +
				'@SW_ENABLE @SW_HIDE @SW_LOCK @SW_MAXIMIZE @SW_MINIMIZE @SW_RESTORE @SW_SHOW @SW_SHOWDEFAULT @SW_SHOWMAXIMIZED ' +
				'@SW_SHOWMINIMIZED @SW_SHOWMINNOACTIVE @SW_SHOWNA @SW_SHOWNOACTIVATE @SW_SHOWNORMAL @SW_UNLOCK @SystemDir @TAB ' +
				'@TempDir @TRAY_ID @TrayIconFlashing @TrayIconVisible @UserProfileDir @UserName @WDAY @WindowsDir @WorkingDir @YDAY @YEAR';
		var keywords =	'Func EndFunc ContinueCase ContinueLoop Default Dim Global Local Const Do Until Enum Exit ExitLoop For To Step Next In If ' +
						'Then Else ElseIf EndIf ReDim Select Case EndSelect Static Switch EndSwitch While WEnd With EndWith';

		var r = SyntaxHighlighter.regexLib;
		
		this.regexList = [
			{ regex: r.multiLineDoubleQuotedString,					css: 'string' },			// double quoted strings
			{ regex: r.multiLineSingleQuotedString,					css: 'string' },			// single quoted strings
			{ regex: r.multiLineCComments,							css: 'comments' },			// multiline comments
			{ regex: /\;.*$/gm										css: 'comments' },			// one line comments
			{ regex: /\s*#.*/gm,									css: 'comments' },			// preprocessor tags like #region and #endregion
			{ regex: /\$\w+/g,										css: 'variable' },			// variables
			{ regex: new RegExp(this.getKeywords(funcs), 'gmi'),	css: 'functions' },			// documented functions
			{ regex: new RegExp(this.getKeywords(keywords), 'gm'),	css: 'keyword' },			// keywords
			{ regex: new RegExp(this.getKeywords(macros), 'gmi'),	css: 'color1' }				// documented macros
			];
	
		this.forHtmlScript(r.scriptScriptTags);
	};

	Brush.prototype	= new SyntaxHighlighter.Highlighter();
	Brush.aliases	= ['au3', 'autoit'];

	SyntaxHighlighter.brushes.Autoit = Brush;

	// CommonJS
	typeof(exports) != 'undefined' ? exports.Brush = Brush : null;
})();
