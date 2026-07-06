import PhotosUI
import SwiftData
import SwiftUI

struct AddEditItemView: View {
    @Environment(\.modelContext) private var modelContext
    @Environment(\.dismiss) private var dismiss

    @State var viewModel: AddEditItemViewModel
    @State private var photoPickerItem: PhotosPickerItem?
    @State private var errorMessage: String?
    @State private var isPresentingDeleteConfirmation = false

    var body: some View {
        NavigationStack {
            Form {
                Section {
                    PhotosPicker(selection: $photoPickerItem, matching: .images) {
                        HStack {
                            if let image = viewModel.displayImage {
                                Image(uiImage: image)
                                    .resizable()
                                    .scaledToFill()
                                    .frame(width: 60, height: 60)
                                    .clipShape(RoundedRectangle(cornerRadius: 8))
                                    .clipped()
                            } else {
                                Image(systemName: "photo.badge.plus")
                                    .font(.largeTitle)
                                    .frame(width: 60, height: 60)
                            }
                            Text(viewModel.displayImage == nil ? "Choose Photo" : "Change Photo")
                        }
                    }
                }

                Section("Details") {
                    TextField("Name", text: $viewModel.name)
                    TextField("Color", text: $viewModel.color)
                    Picker("Category", selection: $viewModel.category) {
                        ForEach(Category.allCases) { category in
                            Text(category.displayName).tag(category)
                        }
                    }
                    Picker("Style", selection: $viewModel.style) {
                        ForEach(Style.allCases) { style in
                            Text(style.displayName).tag(style)
                        }
                    }
                    Picker("Status", selection: $viewModel.status) {
                        ForEach(Status.allCases) { status in
                            Text(status.displayName).tag(status)
                        }
                    }
                }

                if viewModel.isEditing {
                    Section {
                        Button("Delete Item", role: .destructive) {
                            isPresentingDeleteConfirmation = true
                        }
                    }
                }
            }
            .navigationTitle(viewModel.isEditing ? "Edit Item" : "Add Item")
            .navigationBarTitleDisplayMode(.inline)
            .toolbar {
                ToolbarItem(placement: .cancellationAction) {
                    Button("Cancel") { dismiss() }
                }
                ToolbarItem(placement: .confirmationAction) {
                    Button("Save") { save() }
                        .disabled(!viewModel.isValid)
                }
            }
            .onChange(of: photoPickerItem) {
                Task {
                    if let data = try? await photoPickerItem?.loadTransferable(type: Data.self),
                       let uiImage = UIImage(data: data) {
                        viewModel.newlyPickedImage = uiImage
                    }
                }
            }
            .alert(
                "Something went wrong",
                isPresented: Binding(
                    get: { errorMessage != nil },
                    set: { if !$0 { errorMessage = nil } }
                )
            ) {
                Button("OK") { errorMessage = nil }
            } message: {
                Text(errorMessage ?? "")
            }
            .confirmationDialog(
                "Delete this item?",
                isPresented: $isPresentingDeleteConfirmation,
                titleVisibility: .visible
            ) {
                Button("Delete", role: .destructive) {
                    viewModel.delete(context: modelContext)
                    dismiss()
                }
                Button("Cancel", role: .cancel) {}
            }
        }
    }

    private func save() {
        do {
            try viewModel.save(context: modelContext)
            dismiss()
        } catch {
            errorMessage = "Couldn't save this item. Please try again."
        }
    }
}
